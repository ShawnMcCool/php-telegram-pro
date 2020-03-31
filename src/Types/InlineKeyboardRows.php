<?php namespace TelegramPro\Types;

/**
 * array of inline keyboard rows is an interesting way for Telegram to say an "inline keyboard"
 */
final class ArrayOfInlineKeyboardRows extends ArrayOfItems
{
    static function fromApi($items): ArrayOfInlineKeyboardRows
    {
        return new static(
            collect(
                $items
            )->map(
                fn($row) => ArrayOfInlineKeyboardButtons::fromApi($row)
            )
        );
    }
}