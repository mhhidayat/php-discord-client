<?php

namespace Mhhidayat\PhpDiscordClient\Interface;

use Closure;
use Mhhidayat\PhpDiscordClient\Core\MainDiscordClient;

interface DiscordWebhookInterface {
    public static function make(): MainDiscordClient;
    public function setWebhookURL(string $setWebhookURL): MainDiscordClient;
    public function setContent(array|Closure $contentHandler): MainDiscordClient;
    public function addEmbeds(Closure $embedsHandler): MainDiscordClient;
    public function text(string $text): MainDiscordClient;
    public function setUsername(string $username): MainDiscordClient;
    public function setAvatar(string $avatarURL): MainDiscordClient;
    public function allowTTS(): MainDiscordClient;
    public static function withHeaders(array $headers): MainDiscordClient;
    public static function timeout(int $seconds): MainDiscordClient;
    public function send(): MainDiscordClient;
    public function sendWhen(bool|Closure $isSendHandler): MainDiscordClient;
    public function successful(): bool;
    public function failed(): bool;
    public function getResponseJson(): string;
}