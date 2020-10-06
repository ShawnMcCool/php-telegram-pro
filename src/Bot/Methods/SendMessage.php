<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;

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

    function request(): Request
    {
        return Request::json(
            'sendMessage'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'text' => $this->text->toApi(),
                'parse_mode' => $this->parseMode->toApi(),
                'disable_web_page_preview' => optional($this->disableWebPagePreview),
                'disable_notification' => optional($this->disableNotification),
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup)
            ]
        );
    }

    public function send(Telegram $telegramApi): SendMessageResponse
    {
        return SendMessageResponse::fromApi(
            $telegramApi->send($this->request())
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