<?php namespace TelegramPro;

final class InlineKeyboardMarkup
***REMOVED***
    private ?array $inlineKeyboard;

    public function __construct(
        ?array $inlineKeyboard // array of rows (arrays) of InlineKeyboardButtons
    ) ***REMOVED***
        $this->inlineKeyboard = $inlineKeyboard;
    ***REMOVED***

    public static function fromRequest($replyMarkup): ?InlineKeyboardMarkup
    ***REMOVED***
        if ( ! $replyMarkup) return null;
        
        return new static(
            InlineKeyboardButton::arrayOfArraysFromRequest($replyMarkup->inline_keyboard ?? null)
        );
    ***REMOVED***
***REMOVED***