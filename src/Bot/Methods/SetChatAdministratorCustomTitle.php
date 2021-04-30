<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\ChatAdministratorCustomTitle;

/**
 * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
 */
final class SetChatAdministratorCustomTitle implements Method
{
    private function __construct(
        private ChatId $chatId,
        private UserId $userId,
        private ChatAdministratorCustomTitle $customTitle
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setChatAdministratorCustomTitle'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
                'custom_title' => $this->customTitle->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): SetChatAdministratorCustomTitleResponse
    {
        return SetChatAdministratorCustomTitleResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId,
        ChatAdministratorCustomTitle $customTitle
    ): SetChatAdministratorCustomTitle {
        return new static(
            $chatId,
            $userId,
            $customTitle
        );
    }
}