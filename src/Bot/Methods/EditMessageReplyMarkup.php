<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use function TelegramPro\optional;

/**
 * Use this method to edit only the reply markup of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageReplyMarkup implements Method
{
    private ?ChatId $chatId;
    private ?MessageId $messageId;
    private ?InlineMessageId $inlineMessageId;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        ?ChatId $chatId,
        ?MessageId $messageId,
        ?InlineMessageId $inlineMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->inlineMessageId = $inlineMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'editMessageReplyMarkup'
        )->withParameters(
            [
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'reply_markup' => json_encode(optional($this->replyMarkup)),
            ]
        );
    }

    public function send(Telegram $telegramApi): EditMessageReplyMarkupResponse
    {
        return EditMessageReplyMarkupResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parametersForInline(
        InlineMessageId $inlineMessageId,
        ?ReplyMarkup $replyMarkup = null
    ) {
        return new static(
            null,
            null,
            $inlineMessageId,
            $replyMarkup
        );
    }

    public static function parametersForChat(
        ChatId $chatId,
        MessageId $messageId,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $messageId,
            null,
            $replyMarkup
        );
    }
}