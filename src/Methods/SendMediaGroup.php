<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\MediaGroup;
use TelegramPro\Api\CurlParameters;

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

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendMediaGroup')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'media' => $this->mediaGroup->toApi(),
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                          ]
                      )->withFiles($this->mediaGroup->filesToUpload())
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendMediaGroupResponse
    {
        return SendMediaGroupResponse::fromApi(
            $telegramApi->send($this)
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