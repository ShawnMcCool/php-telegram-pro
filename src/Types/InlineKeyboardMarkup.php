<?php namespace TelegramPro\Types;

use ArrayIterator;
use IteratorAggregate;

final class InlineKeyboardMarkup implements ReplyMarkup
{
    private ArrayOfInlineKeyboardRows $inlineKeyboard;

    public function __construct(
        ArrayOfInlineKeyboardRows $inlineKeyboard // array of rows (arrays) of InlineKeyboardButtons
    ) {
        $this->inlineKeyboard = $inlineKeyboard;
    }

    public static function fromApi($replyMarkup): ?InlineKeyboardMarkup
    {
        if ( ! $replyMarkup) return null;
        
        return new static(
            ArrayOfInlineKeyboardRows::fromApi($replyMarkup->inline_keyboard ?? null)
        );
    }

    function toParameter(): ?IteratorAggregate
    {
        return $this->inlineKeyboard;
    }
}