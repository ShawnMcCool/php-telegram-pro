<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;
use TelegramPro\Types\AnimationFile;

final class SendAnimation implements Method
{
    private $chatId;
    private AnimationFile $animation;
    private Text $caption;
    private ?int $duration;
    private ?int $width;
    private ?int $height;
    private ?PhotoFile $thumb;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        AnimationFile $animation,
        Text $caption,
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
                              'animation' => $this->animation->toApi(),
                              'duration' => $this->duration,
                              'width' => $this->width,
                              'height' => $this->height,
                              'thumb' => $this->thumb ? $this->thumb->toApi() : null,
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
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
        $chatId,
        AnimationFile $animation,
        ?Text $caption,
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
            $caption ?? Text::none(),
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