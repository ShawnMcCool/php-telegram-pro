<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;
use function TelegramPro\collect;

/**
 * array of inline keyboard rows is an interesting way for Telegram to say an "inline keyboard"
 */
final class ArrayOfInlineKeyboardRows extends ArrayOfApiTypes implements ApiReadType, ApiWriteType
{
    public static function fromList(ArrayOfInlineKeyboardButtons ...$rowOfButtons): self
    {
        return new static(collect($rowOfButtons));
    }

    function toApi()
    {
        return $this->items
            ->map(
                fn(ArrayOfInlineKeyboardButtons $buttons) => $buttons->toApi()
            )->toArray();
    }

    static function fromApi($items): static
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