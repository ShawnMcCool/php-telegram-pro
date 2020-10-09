<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;

/**
 * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
 */
final class SendDice implements Method
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

    public static function parameters(
        ChatId $chatId,
        Emoji $emoji
    ): GetMe
    {
        return new static;
    }
}