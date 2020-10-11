<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;

/**
 * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 */
final class SetChatPhoto implements Method
{
    private ChatId $chatId;
    private InputPhotoFile $photo;

    private function __construct(
        ChatId $chatId,
        InputPhotoFile $photo
    ) {
        $this->chatId = $chatId;
        $this->photo = $photo;
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'setChatPhoto'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'photo' => $this->photo->toApi()
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->photo->fileToUpload(),
            )
        );
    }

    public function send(Telegram $telegramApi): SetChatPhotoResponse
    {
        return SetChatPhotoResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        InputPhotoFile $photo
    ): self {
        return new static(
            $chatId,
            $photo
        );
    }
}