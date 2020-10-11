<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\ChatTitle;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 */
final class SetChatTitle implements Method
{
    private ChatId $chatId;
    private ChatTitle $title;

    private function __construct(
        ChatId $chatId,
        ChatTitle $title
    ) {
        $this->chatId = $chatId;
        $this->title = $title;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setChatTitle'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'title' => $this->title->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): SetChatTitleResponse
    {
        return SetChatTitleResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        ChatTitle $title
    ): self {
        return new static(
            $chatId,
            $title
        );
    }
}