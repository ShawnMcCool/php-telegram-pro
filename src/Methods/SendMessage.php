<?php namespace TelegramPro\Methods;

use TelegramPro\Types\ReplyMarkup;

final class SendMessage implements Method
***REMOVED***
    private $chatId;
    private string $text;
    private ?ParseMode $parseMode;
    private ?bool $disableWebPagePreview;
    private ?bool $disableNotification;
    private ?int $replyToMessageId;
    private ?ReplyMarkup $replyMarkup;

    private function __construct(
        $chatId,
        string $text,
        ?ParseMode $parseMode,
        ?bool $disableWebPagePreview,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ) ***REMOVED***
        $this->chatId = $chatId;
        $this->text = $text;
        $this->parseMode = $parseMode;
        $this->disableWebPagePreview = $disableWebPagePreview;
        $this->disableNotification = $disableNotification;
        $this->replyToMessageId = $replyToMessageId;
        $this->replyMarkup = $replyMarkup;
    ***REMOVED***

    public function request(): Request
    ***REMOVED***
        return Request::json('sendMessage')
                      ->withParameters(
                          [
                              'chat_id' => $this->chatId,
                              'text' => $this->text,
                              'parse_mode' => $this->parseMode,
                              'disable_web_page_preview' => $this->disableWebPagePreview,
                              'disable_notification' => $this->disableNotification,
                              'reply_to_message_id' => $this->replyToMessageId,
                              'reply_markup' => $this->replyMarkup ? $this->replyMarkup->toParameter() : null, // toParameter
                          ]
                      );
    ***REMOVED***

    public static function parameters(
        $chatId,
        string $text,
        ?ParseMode $parseMode,
        ?bool $disableWebPagePreview,
        ?bool $disableNotification,
        ?int $replyToMessageId,
        ?ReplyMarkup $replyMarkup
    ): SendMessage ***REMOVED***
        return new static(
            $chatId,
            $text,
            $parseMode,
            $disableWebPagePreview,
            $disableNotification,
            $replyToMessageId,
            $replyMarkup
        );
    ***REMOVED***
***REMOVED***