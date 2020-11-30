<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\ArrayOfBotCommands;

/**
 * Use this method to change the list of the bot's commands. Returns True on success.
 */
final class SetMyCommands implements Method
{
    private ArrayOfBotCommands $commands;

    private function __construct(
        ArrayOfBotCommands $commands
    ) {
        $this->commands = $commands;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setMyCommands'
        )->withParameters(
            [
                'commands' => $this->commands->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): SetMyCommandsResponse
    {
        return SetMyCommandsResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ArrayOfBotCommands $commands
    ): static {
        return new static(
            $commands
        );
    }
}