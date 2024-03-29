<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to stop updating a live location message before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
 */
final class StopMessageLiveLocation implements Method
{

    public function __construct(
        private ?ChatId $chatId,
        private ?MessageId $messageId,
        private ?InlineMessageId $inlineMessageId,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'stopMessageLiveLocation'
        )->withParameters(
            [
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    function send(Telegram $telegramApi): StopMessageLiveLocationResponse
    {
        return StopMessageLiveLocationResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ?ChatId $chatId,
        ?MessageId $messageId,
        ?InlineMessageId $inlineMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $messageId,
            $inlineMessageId,
            $replyMarkup
        );
    }
}