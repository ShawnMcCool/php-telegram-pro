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
use TelegramPro\Bot\Methods\FileUploads\AudioInputFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

final class SendAudio implements Method
{

    public function __construct(
        private ChatId $chatId,
        private AudioInputFile $audio,
        private ?MediaCaption $caption,
        private ?ParseMode $parseMode,
        private ?int $duration,
        private ?string $performer,
        private ?string $title,
        private ?InputPhotoFile $thumb,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendAudio'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'audio' => $this->audio->toApi(),
                'thumb' => optional($this->thumb),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'duration' => $this->duration,
                'performer' => $this->performer,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->audio->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null
            )
        );
    }

    function send(Telegram $telegramApi): SendAudioResponse
    {
        return SendAudioResponse::fromApi(
            $telegramApi->send($this->request())
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
    ): static {
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