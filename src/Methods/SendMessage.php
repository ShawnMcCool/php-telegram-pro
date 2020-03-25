<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\Text;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

final class SendMessage implements Method
{
    private $chatId;
    private Text $text;
    private ?bool $disableWebPagePreview;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        $chatId,
        Text $text,
        ?bool $disableWebPagePreview,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->text = $text;
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
                              'text' => $this->text->text(),
                              'parse_mode' => $this->text->parseMode(),
                              'disable_web_page_preview' => $this->disableWebPagePreview,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    public function send(Telegram $telegramApi): SendMessageResponse
    {
        return SendMessageResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        Text $text,
        ?bool $disableWebPagePreview = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): SendMessage {
        return new static(
            $chatId,
            $text,
            $disableWebPagePreview,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}