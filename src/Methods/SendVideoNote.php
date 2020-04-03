<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Methods\FileUploads\VideoNoteFile;
use TelegramPro\Methods\FileUploads\FilesToUpload;
use TelegramPro\Methods\FileUploads\InputPhotoFile;

final class SendVideoNote implements Method
{
    private ChatId $chatId;
    private VideoNoteFile $videoNote;
    private ?int $duration;
    private ?int $length;
    private ?InputPhotoFile $thumb;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        VideoNoteFile $videoNote,
        ?int $duration,
        ?int $length,
        ?InputPhotoFile $thumb,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->videoNote = $videoNote;
        $this->duration = $duration;
        $this->length = $length;
        $this->thumb = $thumb;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toRequest(): Request
    {
        return Request::multipartFormData(
            'sendVideoNote'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'video_note' => $this->videoNote,
                'thumb' => $this->thumb,
                'duration' => $this->duration,
                'length' => $this->length,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        )->withFiles(
            FilesToUpload::list(
                $this->videoNote->fileToUpload(),
                $this->thumb ? $this->thumb->fileToUpload() : null
            )
        );
    }

    function send(Telegram $telegramApi): SendVideoNoteResponse
    {
        return SendVideoNoteResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        VideoNoteFile $videoNote,
        ?int $duration = null,
        ?int $length = null,
        ?InputPhotoFile $thumb = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $videoNote,
            $duration,
            $length,
            $thumb,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}