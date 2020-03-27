<?php namespace TelegramPro\Types;

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