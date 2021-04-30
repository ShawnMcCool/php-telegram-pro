<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\InlineMessageId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
use TelegramPro\Bot\Methods\FileUploads\InputMediaFile;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;
use function TelegramPro\optional;

/**
 * Use this method to edit animation, audio, document, photo, or video messages. If a message is a part of a message album, then it can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageMedia implements Method
{
    private function __construct(
        private ?ChatId $chatId,
        private ?MessageId $messageId,
        private ?InlineMessageId $inlineMessageId,
        private InputMediaFile $media,
        private ?ReplyMarkup $replyMarkup
    ) {
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'editMessageMedia'
        )->withParameters(
            [
                'chat_id' => optional($this->chatId),
                'message_id' => optional($this->messageId),
                'inline_message_id' => optional($this->inlineMessageId),
                'media' => json_encode($this->media->toApi()),
                'reply_markup' => optional($this->replyMarkup),
            ]
        )->withFiles(
            $this->media->filesToUpload()
        );
    }

    public function send(Telegram $telegramApi): EditMessageMediaResponse
    {
        return EditMessageMediaResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parametersForInline(
        InlineMessageId $inlineMessageId,
        InputMediaFile $media,
        ?ReplyMarkup $replyMarkup = null
    ) {
        return new static(
            null,
            null,
            $inlineMessageId,
            $media,
            $replyMarkup
        );
    }

    public static function parametersForChat(
        ChatId $chatId,
        MessageId $messageId,
        InputMediaFile $media,
        ?ReplyMarkup $replyMarkup = null
    ): static {
        return new static(
            $chatId,
            $messageId,
            null,
            $media,
            $replyMarkup
        );
    }
}