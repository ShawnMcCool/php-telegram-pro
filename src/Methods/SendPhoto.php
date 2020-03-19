<?php namespace TelegramPro\Methods;

use CURLFile;
use TelegramPro\Types\InputFile;
use TelegramPro\Http\TelegramApi;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Http\CurlParameters;

final class SendPhoto implements Method
{
    private $chatId;
    private InputFile $photo;
    private ?string $caption;
    private ?ParseMode $parseMode;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        InputFile $photo,
        string $caption,
        ?ParseMode $parseMode,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->photo = $photo;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendPhoto')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'photo' => $this->photo->fileId() ?? $this->photo->url() ?? new CURLFile(realpath($this->photo->filePath())),
                              'caption' => $this->caption,
                              'parse_mode' => $this->parseMode ? $this->parseMode->toParameter() : null,
                              'disable_web_page_preview' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(TelegramApi $telegramApi): SendPhotoResponse
    {
        return SendPhotoResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        InputFile $photo,
        ?string $caption = null,
        ?ParseMode $parseMode = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $photo,
            $caption ?? '',
            $parseMode,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}