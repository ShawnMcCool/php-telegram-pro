<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\VideoNoteFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

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

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendVideoNote'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'video_note' => $this->videoNote->toApi(),
                'thumb' => optional($this->thumb),
                'duration' => $this->duration,
                'length' => $this->length,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
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
            $telegramApi->send($this->request())
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
    ): static {
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