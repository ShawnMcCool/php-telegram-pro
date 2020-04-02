<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ParseMode;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Methods\FileUploads\AudioInputFile;

final class SendAudio implements Method
{
    private ChatId $chatId;
    private AudioInputFile $audio;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?string $performer;
    private ?string $title;
    private ?InputPhotoFile $thumb;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        AudioInputFile $audio,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?string $performer,
        ?string $title,
        ?InputPhotoFile $thumb,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->audio = $audio;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->thumb = $thumb;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toRequest(): Request
    {
        return Request::multipartFormData(
            'sendAudio'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'duration' => $this->duration,
                'performer' => $this->performer,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        )->withFiles(
            [
                'audio' => $this->audio,
                'thumb' => $this->thumb,
            ]
        );
    }

    function send(Telegram $telegramApi): SendAudioResponse
    {
        return SendAudioResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        AudioInputFile $audio,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
        ?InputPhotoFile $thumb = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $audio,
            $caption,
            $parseMode,
            $duration,
            $performer,
            $title,
            $thumb,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}