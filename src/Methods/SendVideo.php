<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\VideoFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

final class SendVideo implements Method
{
    private $chatId;
    private VideoFile $video;
    private ?Text $caption;
    private ?int $duration;
    private ?int $width;
    private ?int $height;
    private ?PhotoFile $thumb;
    private ?bool $supportsStreaming;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        VideoFile $video,
        ?Text $caption,
        ?int $duration,
        ?int $width,
        ?int $height,
        ?PhotoFile $thumb,
        ?bool $supportsStreaming,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) {
        $this->chatId = $chatId;
        $this->video = $video;
        $this->caption = $caption;
        $this->duration = $duration;
        $this->width = $width;
        $this->height = $height;
        $this->thumb = $thumb;
        $this->supportsStreaming = $supportsStreaming;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendVideo')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'video' => $this->video->toApi(),
                              'duration' => $this->duration,
                              'width' => $this->width,
                              'height' => $this->height,
                              'thumb' => $this->thumb ? $this->thumb->toApi() : null,
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'supports_streaming' => $this->supportsStreaming,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendVideoResponse
    {
        return SendVideoResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        VideoFile $video,
        ?Text $caption,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        ?PhotoFile $thumb = null,
        ?bool $supportsStreaming = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $video,
            $caption,
            $duration,
            $width,
            $height,
            $thumb,
            $supportsStreaming,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}