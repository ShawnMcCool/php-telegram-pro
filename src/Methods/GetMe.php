<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Api\CurlParameters;

final class GetMe implements Method
{
    private function __construct() {}

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::queryString('getMe')
                      ->toCurlParameters($botToken);
    }

    public function send(Telegram $telegramApi): GetMeResponse
    {
        return GetMeResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(): GetMe
    {
        return new static;
    }
}