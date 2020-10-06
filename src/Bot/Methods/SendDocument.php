<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\DocumentFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

final class SendDocument implements Method
{
    private ChatId $chatId;
    private DocumentFile $document;
    private ?InputPhotoFile $thumb;
    private ?MediaCaption $caption;
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

    function request(): Request
    {
        return Request::multipartFormData(
            'sendDocument'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'document' => $this->document->toApi(),
                'thumb' => optional($this->thumb),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->document->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null
            )
        );
    }

    function send(Telegram $telegramApi): SendDocumentResponse
    {
        return SendDocumentResponse::fromApi(
            $telegramApi->send($this->request())
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