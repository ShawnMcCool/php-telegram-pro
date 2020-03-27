<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Api\CurlParameters;

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

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::json('forwardMessage')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'from_chat_id' => $this->fromChatId,
                              'disable_notifications' => $this->disableNotification,
                              'message_id' => $this->messageId,
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    public function send(Telegram $telegramApi): ForwardMessageResponse
    {
        return ForwardMessageResponse::fromApi(
            $telegramApi->send($this)
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