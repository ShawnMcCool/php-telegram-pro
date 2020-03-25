<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\MediaGroup;
use TelegramPro\Api\CurlParameters;

final class SendMediaGroup implements Method
{
    private $chatId;
    private MediaGroup $mediaGroup;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;

    public function __construct(
        $chatId,
        MediaGroup $mediaGroup,
        ?bool $disableNotification,
        ?int $replyToMessageId
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
                          array_merge(
                              [
                                  'chat_id' => $this->chatId,
                                  'media' => $this->mediaGroup->toApi(),
                                  'disable_notification' => $this->disableNotification,
                                  'reply_to_message_id' => $this->replyToMessageId,
                              ],
                              $this->mediaGroup->files()
                          )
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendMediaGroupResponse
    {
        return SendMediaGroupResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        MediaGroup $mediaGroup,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null
    ): self {
        return new static(
            $chatId,
            $mediaGroup,
            $disableNotification,
            $replyToMessageId
        );
    }
}