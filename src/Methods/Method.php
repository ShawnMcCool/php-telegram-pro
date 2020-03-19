<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Http\CurlParameters;

interface Method
{
    function toCurlParameters(string $botToken): CurlParameters;
    function send(TelegramApi $telegramApi);
}