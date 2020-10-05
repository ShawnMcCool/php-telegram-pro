<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\MessageId;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;

/**
Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageLiveLocation implements Method
{
    private Latitude $latitude;
    private Longitude $longitude;
    private ?ChatId $chatId;
    private ?MessageId $messageId;
    private ?InlineMessageId $inlineMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        Latitude $latitude,
        Longitude $longitude,
        ?ChatId $chatId,
        ?MessageId $messageId,
        ?InlineMessageId $inlineMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return Request::multipartFormData(
            'editMessageLiveLocation'
        )->withParameters(
            [
                'latitude' => $this->latitude->toApi(),
                'longitude' => $this->longitude->toApi(),
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): EditMessageLiveLocationResponse
    {
        return EditMessageLiveLocationResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        Latitude $latitude,
        Longitude $longitude,
        ?ChatId $chatId,
        ?MessageId $messageId,
        ?InlineMessageId $inlineMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $latitude,
            $longitude,
            $chatId,
            $messageId,
            $inlineMessageId,
            $replyMarkup
        );
    }
}