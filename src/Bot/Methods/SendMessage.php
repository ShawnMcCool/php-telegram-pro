<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

final class SendMessage implements Method
{
    private function __construct(
        private ChatId $chatId,
        private MessageText $text,
        private ParseMode $parseMode,
        private ?bool $disableWebPagePreview,
        private ?bool $disableNotification,
        private ?MessageId $replyToMessageId,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'sendMessage'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'text' => $this->text->toApi($this->parseMode),
                'parse_mode' => $this->parseMode->toApi(),
                'disable_web_page_preview' => optional($this->disableWebPagePreview),
                'disable_notification' => optional($this->disableNotification),
                'reply_to_message_id' => optional($this->replyToMessageId),
                'reply_markup' => optional($this->replyMarkup),
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