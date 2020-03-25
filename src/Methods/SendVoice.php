<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\Text;
use TelegramPro\Types\VoiceFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

final class SendVoice implements Method
{
    private $chatId;
    private VoiceFile $voice;
    private ?Text $caption;
    private ?int $duration;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        VoiceFile $voice,
        ?Text $caption,
        ?int $duration,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->voice = $voice;
        $this->caption = $caption;
        $this->duration = $duration;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendVoice')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'voice' => $this->voice->toApi(),
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'duration' => $this->duration,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendVoiceResponse
    {
        return SendVoiceResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        VoiceFile $audio,
        ?Text $caption = null,
        ?int $duration = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $audio,
            $caption,
            $duration,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}