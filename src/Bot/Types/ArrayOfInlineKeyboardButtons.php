<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;
use TelegramPro\Bot\Methods\Keyboards\InlineKeyboardButton;
use function TelegramPro\collect;

/**
 * Contains multiple inline keyboard buttons. The Telegram API refers to this as either
 * an "array of inline keyboard buttons" or a "keyboard row". A keyboard row is a row on a keyboard
 * that contains multiple buttons.
 */
final class ArrayOfInlineKeyboardButtons extends ArrayOfApiTypes implements ApiReadType, ApiWriteType
{
    function toApi()
    {
        return $this->items
            ->map(
                fn(InlineKeyboardButton $button) => $button->toApi()
            )->toArray();
    }

    public static function fromList(InlineKeyboardButton ...$buttons): self
    {
        return new static(collect($buttons));
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($items): static
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