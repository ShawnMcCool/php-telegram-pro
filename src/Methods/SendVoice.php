<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ParseMode;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\FileUploads\VoiceFile;
use TelegramPro\Methods\FileUploads\FilesToUpload;

final class SendVoice implements Method
{
    private ChatId $chatId;
    private VoiceFile $voice;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        VoiceFile $voice,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->voice = $voice;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toRequest(): Request
    {
        return Request::multipartFormData(
            'sendVoice'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'voice' => $this->voice,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'duration' => $this->duration,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->voice->fileToUpload()
            )
        );
    }

    function send(Telegram $telegramApi): SendVoiceResponse
    {
        return SendVoiceResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        VoiceFile $audio,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
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
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}