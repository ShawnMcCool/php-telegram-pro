<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

/**
 * Contains a list of available photo sizes for a single photo
 */
final class ArrayOfPhotoSizes extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): static
    {
        return new static(
            collect(
                $items
            )->map(
                fn($photoSize) => PhotoSize::fromApi($photoSize)
            )
        );
    }
}