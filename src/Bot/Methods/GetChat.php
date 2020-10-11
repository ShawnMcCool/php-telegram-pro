<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
 */
final class GetChat implements Method
{
    private ChatId $chatId;

    private function __construct(
        ChatId $chatId
    ) {
        $this->chatId = $chatId;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'getChat'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): GetChatResponse
    {
        return GetChatResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId
    ): self {
        return new static(
            $chatId
        );
    }
}