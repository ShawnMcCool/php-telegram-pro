<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\MessageId;

/**
 * Use this method to forward messages of any kind. On success, the sent Message is returned.
 */
final class ForwardMessage implements Method
{
    private ChatId $chatId;
    private ChatId $fromChatId;
    private MessageId $messageId;
    private ?bool $disableNotification;

    private function __construct(
        ChatId $chatId,
        ChatId $fromChatId,
        MessageId $messageId,
        ?bool $disableNotification
    ) {
        $this->chatId = $chatId;
        $this->fromChatId = $fromChatId;
        $this->messageId = $messageId;
        $this->disableNotification = $disableNotification;
    }

    function request(): Request
    {
        return Request::json(
            'forwardMessage'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'from_chat_id' => $this->fromChatId->toApi(),
                'message_id' => $this->messageId->toApi(),
                'disable_notifications' => optional($this->disableNotification),
            ]
        );
    }

    public function send(Telegram $telegramApi): ForwardMessageResponse
    {
        return ForwardMessageResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        ChatId $fromChatId,
        MessageId $messageId,
        ?bool $disableNotification = null
    ): ForwardMessage {
        return new static(
            $chatId,
            $fromChatId,
            $messageId,
            $disableNotification
        );
    }
}