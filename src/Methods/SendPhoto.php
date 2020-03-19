<?php namespace TelegramPro\Methods;

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
        ?string $caption,
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

    }

    function send(TelegramApi $telegramApi)
    {

    }
}