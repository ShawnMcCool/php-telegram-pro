<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\QueryStringRequest;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
 */
final class GetMe implements Method
{
    private function __construct()
    {
    }

    public function send(Telegram $telegramApi): GetMeResponse
    {
        return GetMeResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return QueryStringRequest::forMethod('getMe');
    }

    public static function parameters(): GetMe
    {
        return new static;
    }
}