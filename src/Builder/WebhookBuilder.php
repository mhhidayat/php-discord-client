<?php

namespace Mhhidayat\PhpDiscordClient\Builder;

use Mhhidayat\PhpDiscordClient\DiscordWebhook;

class WebhookBuilder
{
    public static function create(): DiscordWebhook
    {
        return DiscordWebhook::make();
    }

    public static function withConfig(array $config): DiscordWebhook
    {
        $webhook = self::create();
        
        if (isset($config['webhook_url'])) {
            $webhook->setWebhookURL($config['webhook_url']);
        }
        
        if (isset($config['username'])) {
            $webhook->setUsername($config['username']);
        }
        
        if (isset($config['avatar_url'])) {
            $webhook->setAvatar($config['avatar_url']);
        }
        
        return $webhook;
    }
}