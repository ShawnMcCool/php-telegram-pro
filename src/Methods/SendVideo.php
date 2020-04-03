<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Methods\FileUploads\VideoFile;
use TelegramPro\Methods\FileUploads\FilesToUpload;
use TelegramPro\Methods\FileUploads\InputPhotoFile;

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

    function toRequest(): Request
    {
        return Request::multipartFormData(
            'sendVideo'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'duration' => $this->duration,
                'width' => $this->width,
                'height' => $this->height,
                'video' => $this->video,
                'thumb' => $this->thumb,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'supports_streaming' => $this->supportsStreaming,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
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
            $telegramApi->send($this)
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