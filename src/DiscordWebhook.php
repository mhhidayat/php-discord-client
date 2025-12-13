<?php

namespace Mhhidayat\PhpDiscordClient;

use Mhhidayat\PhpDiscordClient\Core\MainDiscordClient;
use Mhhidayat\PhpDiscordClient\Interface\DiscordWebhookInterface;

class DiscordWebhook implements DiscordWebhookInterface
{
    private MainDiscordClient $client;

    public function __construct()
    {
        $this->client = new MainDiscordClient();
    }

    public static function make(): self
    {
        return new self();
    }

    public static function withHeaders(array $headers): self
    {
        $instance = new self();
        $instance->client = MainDiscordClient::withHeaders($headers);
        return $instance;
    }

    public static function timeout(int $seconds): self
    {
        $instance = new self();
        $instance->client = MainDiscordClient::timeout($seconds);
        return $instance;
    }

    public function setWebhookURL(string $setWebhookURL): self
    {
        $this->client->setWebhookURL($setWebhookURL);
        return $this;
    }

    public function setContent(array|\Closure $contentHandler): self
    {
        $this->client->setContent($contentHandler);
        return $this;
    }

    public function addEmbeds(\Closure $embedsHandler): self
    {
        $this->client->addEmbeds($embedsHandler);
        return $this;
    }

    public function text(string $text): self
    {
        $this->client->text($text);
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->client->setUsername($username);
        return $this;
    }

    public function setAvatar(string $avatarURL): self
    {
        $this->client->setAvatar($avatarURL);
        return $this;
    }

    public function allowTTS(): self
    {
        $this->client->allowTTS();
        return $this;
    }

    public function send(): self
    {
        $this->client->send();
        return $this;
    }

    public function sendWhen(bool|\Closure $isSendHandler): self
    {
        $this->client->sendWhen($isSendHandler);
        return $this;
    }

    public function successful(): bool
    {
        return $this->client->successful();
    }

    public function failed(): bool
    {
        return $this->client->failed();
    }

    public function getResponseJson(): string
    {
        return $this->client->getResponseJson();
    }
}