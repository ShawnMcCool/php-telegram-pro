<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Text;
use TelegramPro\Api\Telegram;
use TelegramPro\Types\ChatId;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\MessageId;
use TelegramPro\Types\ReplyMarkup;
use TelegramPro\Types\DocumentFile;
use TelegramPro\Api\CurlParameters;

final class SendDocument implements Method
{
    private ChatId $chatId;
    private DocumentFile $document;
    private ?PhotoFile $thumb;
    private Text $caption;
    private ?bool $disableNotification;
    private ?MessageId $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    public function __construct(
        ChatId $chatId,
        DocumentFile $document,
        ?PhotoFile $thumb,
        Text $caption,
        ?bool $disableNotification,
        ?MessageId $replyToMessageId,
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
                              'caption' => $this->caption->text(),
                              'parse_mode' => $this->caption->parseMode(),
                              'disable_web_page_preview' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ])
                      ->withFiles(
                          [
                              'document' => $this->document,
                              'thumb' => $this->thumb,

                          ])
                      ->toCurlParameters($botToken);
    }

    function send(Telegram $telegramApi): SendPhotoResponse
    {
        return SendPhotoResponse::fromApi(
            $telegramApi->send($this)
        );
    }

    public static function parameters(
        ChatId $chatId,
        DocumentFile $document,
        ?PhotoFile $thumb,
        ?Text $caption = null,
        ?bool $disableNotification = null,
        ?MessageId $replyToMessageId = null,
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