<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\VideoNoteFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

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

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendVideoNote')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'video_note' => $this->videoNote->toApi(),
                              'duration' => $this->duration,
                              'length' => $this->length,
                              'thumb' => $this->thumb ? $this->thumb->toApi() : null,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
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