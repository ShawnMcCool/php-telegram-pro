<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ParseMode;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Types\AnimationFile;

final class SendAnimation implements Method
{
    private ChatId $chatId;
    private AnimationFile $animation;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?int $width;
    private ?int $height;
    private ?PhotoFile $thumb;
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
        ?PhotoFile $thumb,
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

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendAnimation')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'duration' => $this->duration,
                              'width' => $this->width,
                              'height' => $this->height,
                              'caption' => $this->caption,
                              'parse_mode' => $this->parseMode,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null,
                          ]
                      )
                      ->withFiles(
                          [
                              'animation' => $this->animation,
                              'thumb' => $this->thumb,
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendAnimationResponse
    {
        return SendAnimationResponse::fromApi(
            $telegramApi->send($this)
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
        ?PhotoFile $thumb = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
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