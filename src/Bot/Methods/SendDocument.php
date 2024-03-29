<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\DocumentFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

final class SendDocument implements Method
{

    public function __construct(
        private ChatId $chatId,
        private DocumentFile $document,
        private ?InputPhotoFile $thumb,
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
    ): static {
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