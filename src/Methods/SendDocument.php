<?php namespace TelegramPro\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Types\Text;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\DocumentFile;
use TelegramPro\Api\CurlParameters;

final class SendDocument implements Method
{
    private $chatId;
    private DocumentFile $document;
    private ?PhotoFile $thumb;
    private Text $caption;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        $chatId,
        DocumentFile $document,
        ?PhotoFile $thumb,
        Text $caption,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup

    ) {
        $this->chatId = $chatId;
        $this->document = $document;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    }

    function toCurlParameters(string $botToken): CurlParameters
    {
        return Request::multipartFormData('sendDocument')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'document' => $this->document->toApi(),
                              'thumb' => $this->thumb ? $this->thumb->toApi() : null,
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
        DocumentFile $document,
        ?PhotoFile $thumb,
        ?Text $caption = null,
        ?bool $disableNotification = null,
        ?int $replyToMessageId = null,
        ?ReplyMarkup $replyMarkup = null
    ): self {
        return new static(
            $chatId,
            $document,
            $thumb,
            $caption ?? Text::none(),
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    }
}