<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\MediaGroup;
use TelegramPro\Bot\Methods\Requests\MultipartFormRequest;

final class SendMediaGroup implements Method
{
    private ChatId $chatId;
    private MediaGroup $mediaGroup;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;

    public function __construct(
        ChatId $chatId,
        MediaGroup $mediaGroup,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId
    ) {
        $this->chatId = $chatId;
        $this->mediaGroup = $mediaGroup;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
    }

    function request(): Request
    {
        return MultipartFormRequest::forMethod(
            'sendMediaGroup'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'media' => $this->mediaGroup->toApi(),
                'disable_notification' => $this->disableNotification,
                'reply_to_message_id' => optional($this->replyToMessageId),
            ]
        )->withFiles(
            $this->mediaGroup->filesToUpload()
        );
    }

    function send(Telegram $telegramApi): SendMediaGroupResponse
    {
        return SendMediaGroupResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        MediaGroup $mediaGroup,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null
    ): self {
        return new static(
            $chatId,
            $mediaGroup,
            $disableNotification,
            $replyToMessageId
        );
    }
}