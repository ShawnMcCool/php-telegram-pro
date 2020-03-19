<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Http\CurlParameters;

final class SendMessage implements Method
{
    private $chatId;
    private string $text;
    private ?ParseMode $parseMode;
    private ?bool $disableWebPagePreview;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        $chatId,
        string $text,
        ?ParseMode $parseMode,
        ?bool $disableWebPagePreview,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->text = $text;
        $this->parseMode = $parseMode;
        $this->disableWebPagePreview = $disableWebPagePreview;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::json('sendMessage')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'text' => $this->text,
                              'parse_mode' => $this->parseMode,
                              'disable_web_page_preview' => $this->disableWebPagePreview,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    public function send(TelegramApi $telegramApi): SendMessageResponse
    {
        return SendMessageResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        string $text,
        ?ParseMode $parseMode = null,
        ?bool $disableWebPagePreview = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): SendMessage {
        return new static(
            $chatId,
            $text,
            $parseMode,
            $disableWebPagePreview,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}