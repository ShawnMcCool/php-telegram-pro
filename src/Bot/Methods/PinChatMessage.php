<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to pin a message in a group, a supergroup, or a channel. The bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in the supergroup or 'can_edit_messages' admin right in the channel. Returns True on success.
 */
final class PinChatMessage implements Method
{
    private function __construct(
        private ChatId $chatId,
        private MessageId $messageId,
        private ?bool $disableNotification
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'pinChatMessage'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'message_id' => $this->messageId->toApi(),
                'disable_notification' => $this->disableNotification,
            ]
        );
    }

    public function send(Telegram $telegramApi): PinChatMessageResponse
    {
        return PinChatMessageResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        MessageId $messageId,
        ?bool $disableNotification = null
    ): static {
        return new static(
            $chatId,
            $messageId,
            $disableNotification
        );
    }
}