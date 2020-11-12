<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 */
final class SetChatStickerSet implements Method
{
    private ChatId $chatId;
    private string $stickerSetName;

    private function __construct(
        ChatId $chatId,
        string $stickerSetName
    ) {
        $this->chatId = $chatId;
        $this->stickerSetName = $stickerSetName;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setChatStickerSet'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'sticker_set_name' => $this->stickerSetName,
            ]
        );
    }

    public function send(Telegram $telegramApi): SetChatStickerSetResponse
    {
        return SetChatStickerSetResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        string $stickerSetName
    ): self {
        return new static(
            $chatId,
            $stickerSetName
        );
    }
}