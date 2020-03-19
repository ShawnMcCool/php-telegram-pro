<?php namespace TelegramPro\Types;

final class InlineKeyboardMarkup implements ReplyMarkup
***REMOVED***
    private ?array $inlineKeyboard;

    public function __construct(
        ?array $inlineKeyboard // array of rows (arrays) of InlineKeyboardButtons
    ) ***REMOVED***
        $this->inlineKeyboard = $inlineKeyboard;
    ***REMOVED***

    public static function fromApi($replyMarkup): ?InlineKeyboardMarkup
    ***REMOVED***
        if ( ! $replyMarkup) return null;
        
        return new static(
            InlineKeyboardButton::arrayOfArraysfromApi($replyMarkup->inline_keyboard ?? null)
        );
    ***REMOVED***

    function toParameter(): ?array
    ***REMOVED***
        return $this->inlineKeyboard;
    ***REMOVED***
***REMOVED***