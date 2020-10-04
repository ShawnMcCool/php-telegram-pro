<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

final class SendPhoto implements Method
{
    private ChatId $chatId;
    private InputPhotoFile $photo;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        InputPhotoFile $photo,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->photo = $photo;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return Request::multipartFormData(
            'sendPhoto'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'photo' => $this->photo->toApi(),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
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
    ): self {
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