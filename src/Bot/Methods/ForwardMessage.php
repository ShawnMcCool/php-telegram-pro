<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

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
        return JsonRequest::forMethod(
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