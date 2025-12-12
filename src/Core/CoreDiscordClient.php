<?php

namespace Mhhidayat\PhpDiscordClient\Core;

use Mhhidayat\PhpDiscordClient\Exception\DiscordClientException;
use Mhhidayat\PhpDiscordClient\Http\HttpClient;
use Mhhidayat\PhpDiscordClient\Http\HttpResponse;

class CoreDiscordClient
{
    protected string $webhookURL = "";
    protected string $text = "";
    protected string $username = "";
    protected string $avatarURL = "";
    protected array $content = [];
    protected array $embeds = [];
    protected bool $allowTTS = false;
    protected ?HttpResponse $lastResponse = null;
    protected HttpClient $httpClient;

    public function __construct(array $headers = [], int $timeout = 15)
    {
        $this->httpClient = new HttpClient($headers, $timeout);
    }

    protected function getURL(): string
    {
        if (empty($this->webhookURL)) {
            throw new DiscordClientException(
                "Webhook URL is not set. Use the setWebhookURL() method to set it."
            );
        }
        return $this->webhookURL;
    }

    protected function buildPayload(): array
    {
        if (!empty($this->text)) {
            $payload = ["content" => $this->text];
        } elseif (!empty($this->content)) {
            $payload = $this->content;
        } else {
            throw new DiscordClientException(
                "No content is set. Use the text() or setContent() method to set it."
            );
        }

        if (!empty($this->username)) {
            $payload["username"] = $this->username;
        }
        
        if (!empty($this->avatarURL)) {
            $payload["avatar_url"] = $this->avatarURL;
        }
        
        if ($this->allowTTS) {
            $payload["tts"] = true;
        }

        if (!empty($this->embeds)) {
            $payload["embeds"] = [$this->embeds];
        }

        return $payload;
    }

    protected function sendRequest(): void
    {
        $url = $this->getURL();
        $payload = json_encode($this->buildPayload());
        
        $this->lastResponse = $this->httpClient->post($url, $payload);
    }
}