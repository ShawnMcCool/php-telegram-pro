<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Http\CurlParameters;

final class GetMe implements Method
{
    private function __construct()
    {
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::queryString('getMe')
            ->toCurlParameters($botToken);
    }

    public static function parameters(array $parameters = []): GetMe
    {
        return new static;
    }
    
    public function send(TelegramApi $telegramApi): GetMeResponse
    {
        return GetMeResponse::fromApi(
            $telegramApi->send($this)
        );
    }
}