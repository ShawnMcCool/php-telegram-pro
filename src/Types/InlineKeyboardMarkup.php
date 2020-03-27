<?php namespace TelegramPro\Types;

final class InlineKeyboardMarkup implements ReplyMarkup
{
    private ArrayOfInlineKeyboardRows $inlineKeyboard;

    public function __construct(
        ArrayOfInlineKeyboardRows $inlineKeyboard
    ) {
        $this->inlineKeyboard = $inlineKeyboard;
    }

    public function toParameter(): ArrayOfInlineKeyboardRows
    {
        return $this->inlineKeyboard;
    }

    public static function fromApi($replyMarkup): ?InlineKeyboardMarkup
    {
        if ( ! $replyMarkup) return null;

        return new static(
            ArrayOfInlineKeyboardRows::fromApi($replyMarkup->inline_keyboard ?? null)
        );
    }
}