<?php namespace TelegramPro\Types;

use TelegramPro\Methods\Keyboards\InlineKeyboardButton;

/**
 * Contains multiple inline keyboard buttons. The Telegram API refers to this as either 
 * an "array of inline keyboard buttons" or a "keyboard row". A keyboard row is a row on a keyboard
 * that contains multiple buttons. 
 */
final class ArrayOfInlineKeyboardButtons extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
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