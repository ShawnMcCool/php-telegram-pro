<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
 */
final class GetMe implements Method
{
    private function __construct() {}

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return Request::queryString('getMe');
    }

    public function send(Telegram $telegramApi): GetMeResponse
    {
        return GetMeResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(): GetMe
    {
        return new static;
    }
}