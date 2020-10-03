<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\MessageId;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\LivePeriod;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;

final class SendLocation implements Method
{
    private ChatId $chatId;
    private Latitude $latitude;
    private Longitude $longitude;
    private ?LivePeriod $livePeriod;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        Latitude $latitude,
        Longitude $longitude,
        ?LivePeriod $livePeriod,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->livePeriod = $livePeriod;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return Request::multipartFormData(
            'sendLocation'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'latitude' => $this->latitude->toApi(),
                'longitude' => $this->latitude->toApi(),
                'live_period' => optional($this->livePeriod),
                'disable_web_page_preview' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): SendLocationResponse
    {
        return SendLocationResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        Latitude $latitude,
        Longitude $longitude,
        ?LivePeriod $livePeriod = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $latitude,
            $longitude,
            $livePeriod,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}