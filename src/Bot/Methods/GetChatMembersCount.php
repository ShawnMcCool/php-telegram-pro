<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to get the number of members in a chat. Returns Int on success.
 */
final class GetChatMembersCount implements Method
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
            'getChatMembersCount'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): GetChatMembersCountResponse
    {
        return GetChatMembersCountResponse::fromApi(
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