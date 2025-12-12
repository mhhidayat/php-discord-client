<?php

namespace Mhhidayat\PhpDiscordClient\Core;

use Mhhidayat\PhpDiscordClient\Exception\DiscordClientException;

class CoreDiscordClient
{

    protected string $setWebhookURL = "";
    protected string $JSONResponse = "";
    protected string $text = "";
    protected string $username = "";
    protected string $avatarURL = "";
    protected array $content = [];
    protected array $headers = [
        "Content-Type: application/json",
    ];
    protected array $embeds = [];
    protected bool $isSuccessful = false, $allowTTS = false;
    protected int $timeout = 15;

    /**
     * @param int $statusCode
     * @return void
     */
    protected function parseResponseStatusCode(int $statusCode): void
    {
        $this->isSuccessful = $statusCode >= 200 && $statusCode < 300;
    }

    /**
     * @return string
     */
    protected function getURL(): string
    {
        if (!$this->setWebhookURL) {
            throw new DiscordClientException(
                "Webhook URL is not set. Use the setWebhookURL() method to set it."
            );
        }
        return $this->setWebhookURL;
    }

    /**
     * @return string
     */
    protected function getContentEncode(): string
    {
        if ($this->text) {
            $content = ["content" => $this->text];

            if ($this->username) $content["username"] = $this->username;
            if ($this->avatarURL) $content["avatar_url"] = $this->avatarURL;
            if ($this->allowTTS) $content["tts"] = $this->allowTTS;

            if (!empty($this->embeds)) {
                $content["embeds"] = [$this->embeds];
            }

            return json_encode($content);
        }

        if (empty($this->content)) {
            throw new DiscordClientException(
                "The content is not set. Use the text() or setContent() method to set it."
            );
        }

        $content = $this->content;
        if (!empty($this->embeds)) {
            $content["embeds"] = [$this->embeds];
        }

        return json_encode($content);
    }

    /**
     * Send request to Discord webhook
     * @return void
     */
    protected function httpRequestClient(): void
    {
        $url = $this->getURL();
        $reqClient = $this->getContentEncode();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $reqClient);
        
        $response = curl_exec($ch);
        
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new DiscordClientException("cURL error: " . $error);
        }
        
        $this->JSONResponse = $response;
        $responseStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $this->parseResponseStatusCode($responseStatusCode);
    }
}
