<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\QueryStringRequest;

/**
 * Use this method to get the current list of the bot's commands. Requires no parameters. Returns Array of BotCommand on success.
 */
final class GetMyCommands implements Method
{
    public function send(Telegram $telegramApi): GetMyCommandsResponse
    {
        return GetMyCommandsResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return QueryStringRequest::forMethod('getMyCommands');
    }

    public static function parameters(): GetMyCommands
    {
        return new static;
    }
}