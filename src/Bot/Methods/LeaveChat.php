<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
 */
final class LeaveChat implements Method
{
    private function __construct(
        private ChatId $chatId
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'leaveChat'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): LeaveChatResponse
    {
        return LeaveChatResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId
    ): static {
        return new static(
            $chatId
        );
    }
}