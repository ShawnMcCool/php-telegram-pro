<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\ChatDescription;

/**
 * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 */
final class SetChatDescription implements Method
{
    private ChatId $chatId;
    private ChatDescription $description;

    private function __construct(
        ChatId $chatId,
        ChatDescription $description
    ) {
        $this->chatId = $chatId;
        $this->description = $description;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setChatDescription'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'description' => $this->description->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): SetChatDescriptionResponse
    {
        return SetChatDescriptionResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        ChatDescription $description
    ): static {
        return new static(
            $chatId,
            $description
        );
    }
}