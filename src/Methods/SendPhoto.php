<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Api\CurlParameters;

final class SendPhoto implements Method
{
    private $chatId;
    private PhotoFile $photo;
    private Text $caption;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        PhotoFile $photo,
        Text $caption,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->photo = $photo;
        $this->caption = $caption;
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
                              'photo' => $this->photo->toApi(),
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'disable_web_page_preview' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      )
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendPhotoResponse
    {
        return SendPhotoResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        $chatId,
        PhotoFile $photo,
        ?Text $caption = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $photo,
            $caption ?? Text::none(),
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}