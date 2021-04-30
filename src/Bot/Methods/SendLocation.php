<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\LivePeriod;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to send point on the map. On success, the sent Message is returned.
 */
final class SendLocation implements Method
{

    public function __construct(
        private ChatId $chatId,
        private Latitude $latitude,
        private Longitude $longitude,
        private ?LivePeriod $livePeriod,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'sendLocation'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'latitude' => $this->latitude->toApi(),
                'longitude' => optional($this->latitude),
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
    ): static {
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