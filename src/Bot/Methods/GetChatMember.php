<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
 */
final class GetChatMember implements Method
{
    private ChatId $chatId;
    private UserId $userId;

    private function __construct(
        ChatId $chatId,
        UserId $userId
    ) {
        $this->chatId = $chatId;
        $this->userId = $userId;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'getChatMember'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): GetChatMemberResponse
    {
        return GetChatMemberResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId
    ): self {
        return new static(
            $chatId,
            $userId
        );
    }
}