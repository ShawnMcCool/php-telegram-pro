<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;

interface Method
{
    function toRequest(): Request;
    function send(Telegram $telegramApi);
}