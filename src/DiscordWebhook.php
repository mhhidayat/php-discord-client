<?php

namespace Mhhidayat\PhpDiscordClient;

use Mhhidayat\PhpDiscordClient\Core\CoreDiscordClient;
use Mhhidayat\PhpDiscordClient\Interface\DiscordWebhookInterface;
use Mhhidayat\PhpDiscordClient\Trait\HasDiscordClient;

/**
 * Discord Webhook Client
 *
 * @method static static make()
 * @method static static withConfig(array $config)
 * @method static static withHeaders(array $headers)
 * @method static static timeout(int $seconds)
 *
 * @method self setWebhookURL(string $webhookURL)
 * @method self setContent(array|\Closure $contentHandler)
 * @method self addEmbeds(\Closure $embedsHandler)
 * @method self text(string $text)
 * @method self setUsername(string $username)
 * @method self setAvatar(string $avatarURL)
 * @method self allowTTS()
 * @method self send()
 * @method self sendWhen(bool|\Closure $isSendHandler)
 *
 * @method bool successful()
 * @method bool failed()
 * @method string getResponseJson()
 */
class DiscordWebhook extends CoreDiscordClient implements DiscordWebhookInterface
{
    use HasDiscordClient;
}