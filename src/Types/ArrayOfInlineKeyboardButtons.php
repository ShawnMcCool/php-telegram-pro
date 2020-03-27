<?php namespace TelegramPro\Types;

final class ArrayOfInlineKeyboardButtons extends ArrayOfItems
{
    public static function fromApi($items): ArrayOfInlineKeyboardButtons
    {
        return new static(
            collect(
                $items
            )->map(
                fn($inlineKeyboardButton) => InlineKeyboardButton::fromApi($inlineKeyboardButton)
            )
        );
    }
}