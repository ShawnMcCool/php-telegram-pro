<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\DiceEmoji;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
 */
final class SendDice implements Method
{
    private ChatId $chatId;
    private ?DiceEmoji $emoji;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        ?DiceEmoji $emoji,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->emoji = $emoji;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    public function send(Telegram $telegramApi): SendDiceResponse
    {
        return SendDiceResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return JsonRequest::forMethod(
            'sendDice'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'emoji' => optional($this->emoji),
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    public static function parameters(
        ChatId $chatId,
        ?DiceEmoji $emoji = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): SendDice {
        return new static(
            $chatId,
            $emoji,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}