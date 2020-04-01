<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\VideoNoteFile;

final class SendVideoNote implements Method
{
    private ChatId $chatId;
    private VideoNoteFile $videoNote;
    private ?int $duration;
    private ?int $length;
    private ?PhotoFile $thumb;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        VideoNoteFile $videoNote,
        ?int $duration,
        ?int $length,
        ?PhotoFile $thumb,
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
                'duration' => $this->duration,
                'length' => $this->length,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        )->withFiles(
            [
                'video_note' => $this->videoNote,
                'thumb' => $this->thumb,
            ]
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
        ?PhotoFile $thumb = null,
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