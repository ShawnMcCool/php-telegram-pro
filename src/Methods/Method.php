<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Api\CurlParameters;

interface Method
{
    function toCurlParameters(string $botToken): CurlParameters;

    function send(Telegram $telegramApi);
}