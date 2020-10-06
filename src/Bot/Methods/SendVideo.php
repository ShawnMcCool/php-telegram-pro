<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\VideoFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

final class SendVideo implements Method
{
    private ChatId $chatId;
    private VideoFile $video;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?int $width;
    private ?int $height;
    private ?InputPhotoFile $thumb;
    private ?bool $supportsStreaming;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        VideoFile $video,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?int $width,
        ?int $height,
        ?InputPhotoFile $thumb,
        ?bool $supportsStreaming,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->video = $video;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->width = $width;
        $this->height = $height;
        $this->thumb = $thumb;
        $this->supportsStreaming = $supportsStreaming;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return Request::multipartFormData(
            'sendVideo'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'video' => $this->video->toApi(),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'duration' => $this->duration,
                'width' => $this->width,
                'height' => $this->height,
                'thumb' => optional($this->thumb),
                'supports_streaming' => $this->supportsStreaming,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->video->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null,
            )
        );
    }

    function send(Telegram $telegramApi): SendVideoResponse
    {
        return SendVideoResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        VideoFile $video,
        ?MediaCaption $caption,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        ?InputPhotoFile $thumb = null,
        ?bool $supportsStreaming = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $video,
            $caption,
            $parseMode,
            $duration,
            $width,
            $height,
            $thumb,
            $supportsStreaming,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}