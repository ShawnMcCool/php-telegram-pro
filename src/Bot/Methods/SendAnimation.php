<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\AnimationFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

final class SendAnimation implements Method
{
    private ChatId $chatId;
    private AnimationFile $animation;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?int $width;
    private ?int $height;
    private ?InputPhotoFile $thumb;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        AnimationFile $animation,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?int $width,
        ?int $height,
        ?InputPhotoFile $thumb,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->animation = $animation;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->width = $width;
        $this->height = $height;
        $this->thumb = $thumb;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendAnimation'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'animation' => $this->animation->toApi(),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'duration' => optional($this->duration),
                'width' => optional($this->width),
                'height' => optional($this->height),
                'thumb' => optional($this->thumb),
                'disable_notification' => optional($this->disableNotification),
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->animation->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null
            )
        );
    }

    function send(Telegram $telegramApi): SendAnimationResponse
    {
        return SendAnimationResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        AnimationFile $animation,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        ?InputPhotoFile $thumb = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $animation,
            $caption,
            $parseMode,
            $duration,
            $width,
            $height,
            $thumb,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}