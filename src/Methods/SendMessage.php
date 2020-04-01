<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ParseMode;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\MessageText;

final class SendMessage implements Method
{
    private ChatId $chatId;
    private MessageText $text;
    private ParseMode $parseMode;
    private ?bool $disableWebPagePreview;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        ChatId $chatId,
        MessageText $text,
        ParseMode $parseMode,
        ?bool $disableWebPagePreview,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
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

    function toRequest(): Request
    {
        return Request::json(
            'sendMessage'
        )->withParameters(
            [
                'chat_id' => $this->chatId,
                'text' => $this->text,
                'parse_mode' => $this->parseMode,
                'disable_web_page_preview' => $this->disableWebPagePreview,
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => $this->replyToMessageId,
                'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
            ]
        );
    }

    public function send(Telegram $telegramApi): SendMessageResponse
    {
        return SendMessageResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        MessageText $text,
        ?ParseMode $parseMode = null,
        ?bool $disableWebPagePreview = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): SendMessage {
        return new static(
            $chatId,
            $text,
            $parseMode ?? ParseMode::none(),
            $disableWebPagePreview,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}