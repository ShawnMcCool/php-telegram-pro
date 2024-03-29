<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

final class SendPhoto implements Method
{

    public function __construct(
        private ChatId $chatId,
        private InputPhotoFile $photo,
        private ?MediaCaption $caption,
        private ?ParseMode $parseMode,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup

    ) {
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendPhoto'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'photo' => $this->photo->toApi(),
                'caption' => optional($this->caption?->toApi($this->parseMode)),
                'parse_mode' => optional($this->parseMode),
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->photo->fileToUpload(),
            )
        );
    }

    function send(Telegram $telegramApi): SendPhotoResponse
    {
        return SendPhotoResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        InputPhotoFile $photo,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $photo,
            $caption,
            $parseMode,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}