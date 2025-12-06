<?php

namespace Mhhidayat\PhpWebhookDiscord;

class CoreDiscordWebhook
{

    protected string $setWebhookURL = "", $JSONResponse = "", $text = "", $username = "", $avatarURL = "";
    protected array $content, $headers = [
        "Content-Type: application/json",
    ];
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
            throw new DiscordWebhookException(
                "Webhook URL belum di set. Gunakan method setWebhookURL() untuk mengaturnya."
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
            return json_encode(array_filter([
                "content"    => $this->text,
                "username"   => $this->username,
                "avatar_url" => $this->avatarURL,
                "tts"        => $this->allowTTS,
            ], fn($v) => $v !== null));

            return json_encode($contentSend);
        }

        if (empty($this->content)) {
            throw new DiscordWebhookException(
                "Pesan belum di set. Gunakan method setMessage() untuk mengaturnya."
            );
        }
        return json_encode($this->content);
    }

    /**
     * Mengirim request ke Discord webhook
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
        $this->JSONResponse = curl_exec($ch);

        $responseStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->parseResponseStatusCode($responseStatusCode);
    }
}
