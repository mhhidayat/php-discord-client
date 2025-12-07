<?php

namespace Mhhidayat\PhpWebhookDiscord\Enum;

enum Colors: int
{
    // =========================
    // Discord Embed Colors
    // =========================
    case Default = 0;
    case Aqua = 1752220;
    case DarkAqua = 1146986;
    case Green = 5763719;
    case DarkGreen = 2067276;
    case Blue = 3447003;
    case DarkBlue = 2123412;
    case Purple = 10181046;
    case DarkPurple = 7419530;
    case LuminousVividPink = 15277667;
    case DarkVividPink = 11342935;
    case Gold = 15844367;
    case DarkGold = 12745742;
    case Orange = 15105570;
    case DarkOrange = 11027200;
    case Red = 15548997;
    case DarkRed = 10038562;
    case Grey = 9807270;
    case DarkGrey = 9936031;
    case DarkerGrey = 8359053;
    case LightGrey = 12370112;
    case Navy = 3426654;
    case DarkNavy = 2899536;
    case Yellow = 16776960;

    // =========================
    // Official Discord Palette
    // =========================
    case White = 16777215;
    case Greyple = 10070709;
    case Black = 2303786;
    case DarkButNotBlack = 2895667;
    case Blurple = 5793266;
    case DiscordYellow = 16705372; 
    case Fuchsia = 15418782;

    // =========================
    // Other Role Colors
    // =========================
    case UnnamedRole1 = 6323595;
    case UnnamedRole2 = 5533306;
    case BackgroundBlack = 3553599;
}
