<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to edit captions of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageCaption implements Method
{
    private ?ChatId $chatId;
    private ?MessageId $messageId;
    private ?InlineMessageId $inlineMessageId;
    private MediaCaption $caption;
    private ParseMode $parseMode;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        ?ChatId $chatId,
        ?MessageId $messageId,
        ?InlineMessageId $inlineMessageId,
        MediaCaption $caption,
        ParseMode $parseMode,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'editMessageCaption'
        )->withParameters(
            [
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'reply_markup' => optional($this->replyMarkup),
            ]
        );
    }

    public function send(Telegram $telegramApi): EditMessageCaptionResponse
    {
        return EditMessageCaptionResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parametersForInline(
        InlineMessageId $inlineMessageId,
        MediaCaption $caption,
        ?ParseMode $parseMode = null,
        ?ReplyMarkup $replyMarkup = null
    ) {
        return new static(
            null,
            null,
            $inlineMessageId,
            $caption,
            $parseMode ?? ParseMode::none(),
            $replyMarkup
        );
    }

    public static function parametersForChat(
        ChatId $chatId,
        MessageId $messageId,
        MediaCaption $caption,
        ?ParseMode $parseMode = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $messageId,
            null,
            $caption,
            $parseMode ?? ParseMode::none(),
            $replyMarkup
        );
    }
}