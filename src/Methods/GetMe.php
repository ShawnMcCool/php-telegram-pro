<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;

final class GetMe implements Method
{
    private function __construct() {}

    function toRequest(): Request
    {
        return Request::queryString('getMe');

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