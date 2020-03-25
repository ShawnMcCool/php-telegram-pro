<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\AudioFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

final class SendAudio implements Method
{
    private $chatId;
    private AudioFile $audio;
    private Text $caption;
    private ?int $duration;
    private ?string $performer;
    private ?string $title;
    private ?PhotoFile $thumb;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        AudioFile $audio,
        Text $caption,
        ?int $duration,
        ?string $performer,
        ?string $title,
        ?PhotoFile $thumb,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->audio = $audio;
        $this->caption = $caption;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->thumb = $thumb;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendAudio')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'audio' => $this->audio->toApi(),
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'duration' => $this->duration,
                              'performer' => $this->performer,
                              'thumb' => $this->thumb ? $this->thumb->toApi() : null,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendAudioResponse
    {
        return SendAudioResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        AudioFile $audio,
        ?Text $caption = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
        ?PhotoFile $thumb = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $audio,
            $caption ?? Text::none(),
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