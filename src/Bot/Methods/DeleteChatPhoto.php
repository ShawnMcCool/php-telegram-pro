<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 */
final class DeleteChatPhoto implements Method
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
            'deleteChatPhoto'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): DeleteChatPhotoResponse
    {
        return DeleteChatPhotoResponse::fromApi(
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