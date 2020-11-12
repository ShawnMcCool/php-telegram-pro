<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to send information about a venue. On success, the sent Message is returned.
 */
final class SendVenue implements Method
{
    private ChatId $chatId;
    private Latitude $latitude;
    private Longitude $longitude;
    private string $title;
    private string $address;
    private ?string $foursquareId;
    private ?string $foursquareType;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        Latitude $latitude,
        Longitude $longitude,
        string $title,
        string $address,
        ?string $foursquareId,
        ?string $foursquareType,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->title = $title;
        $this->address = $address;
        $this->foursquareId = $foursquareId;
        $this->foursquareType = $foursquareType;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'sendVenue'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'latitude' => $this->latitude->toApi(),
                'longitude' => optional($this->latitude),
                'title' => $this->title,
                'address' => $this->address,
                'foursquareId' => $this->foursquareId,
                'foursquareType' => $this->foursquareType,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): SendVenueResponse
    {
        return SendVenueResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        Latitude $latitude,
        Longitude $longitude,
        string $title,
        string $address,
        ?string $foursquareId = null,
        ?string $foursquareType = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $latitude,
            $longitude,
            $title,
            $address,
            $foursquareId,
            $foursquareType,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup,
        );
    }
}