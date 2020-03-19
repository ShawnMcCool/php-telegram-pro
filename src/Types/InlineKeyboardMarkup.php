<?php namespace TelegramPro\Types;

final class InlineKeyboardMarkup implements ReplyMarkup
{
    private ?array $inlineKeyboard;

    public function __construct(
        ?array $inlineKeyboard // array of rows (arrays) of InlineKeyboardButtons
    ) {
        $this->inlineKeyboard = $inlineKeyboard;
    }

    public static function fromApi($replyMarkup): ?InlineKeyboardMarkup
    {
        if ( ! $replyMarkup) return null;
        
        return new static(
            InlineKeyboardButton::arrayOfArraysfromApi($replyMarkup->inline_keyboard ?? null)
        );
    }

    function toParameter(): ?array
    {
        return $this->inlineKeyboard;
    }
}