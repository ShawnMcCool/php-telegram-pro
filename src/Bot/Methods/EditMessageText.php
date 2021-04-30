<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to edit text and game messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageText implements Method
{
    private function __construct(
        private ?ChatId $chatId,
        private ?MessageId $messageId,
        private ?InlineMessageId $inlineMessageId,
        private MessageText $text,
        private ParseMode $parseMode,
        private ?bool $disableWebPagePreview,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'editMessageText'
        )->withParameters(
            [
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'text' => $this->text->toApi($this->parseMode),
                'parse_mode' => $this->parseMode->toApi(),
                'disable_web_page_preview' => $this->disableWebPagePreview,
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    public function send(Telegram $telegramApi): EditMessageTextResponse
    {
        return EditMessageTextResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parametersForInline(
        InlineMessageId $inlineMessageId,
        MessageText $text,
        ?ParseMode $parseMode = null,
        ?bool $disableWebPagePreview = null,
        ?ReplyMarkup $replyMarkup = null
    ) {
        return new static(
            null,
            null,
            $inlineMessageId,
            $text,
            $parseMode ?? ParseMode::none(),
            $disableWebPagePreview,
            $replyMarkup
        );
    }

    public static function parametersForChat(
        ChatId $chatId,
        MessageId $messageId,
        MessageText $text,
        ?ParseMode $parseMode = null,
        ?bool $disableWebPagePreview = null,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $messageId,
            null,
            $text,
            $parseMode ?? ParseMode::none(),
            $disableWebPagePreview,
            $replyMarkup
        );
    }
}