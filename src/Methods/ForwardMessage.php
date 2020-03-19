<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Http\CurlParameters;

final class ForwardMessage implements Method
{
    private $chatId;
    private $fromChatId;
    private int $messageId;
    private ?bool $disableNotification;

    private function __construct(
        $chatId,
        $fromChatId,
        int $messageId,
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

    public function send(TelegramApi $telegramApi): ForwardMessageResponse
    {
        return ForwardMessageResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        $fromChatId,
        int $messageId,
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