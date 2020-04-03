<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Methods\FileUploads\DocumentFile;
use TelegramPro\Methods\FileUploads\FilesToUpload;
use TelegramPro\Methods\FileUploads\InputPhotoFile;

final class SendDocument implements Method
{
    private ChatId $chatId;
    private DocumentFile $document;
    private ?InputPhotoFile $thumb;
    private MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        DocumentFile $document,
        ?InputPhotoFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->document = $document;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toRequest(): Request
    {
        return Request::multipartFormData(
            'sendDocument'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'document' => $this->document,
                'thumb' => $this->thumb,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->document->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null
            )
        );
    }

    function send(Telegram $telegramApi): SendPhotoResponse
    {
        return SendPhotoResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        DocumentFile $document,
        ?InputPhotoFile $thumb,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $document,
            $thumb,
            $caption,
            $parseMode,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}