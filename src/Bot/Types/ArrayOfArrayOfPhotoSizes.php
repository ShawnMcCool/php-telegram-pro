<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ArrayOfPhotoSizes;
use function TelegramPro\collect;

/**
 * Contains photo size information for multiple photos
 */
final class ArrayOfArrayOfPhotoSizes extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): self
    {
        return new static(
            collect(
                $items
            )->map(
                fn($photoSizes) => ArrayOfPhotoSizes::fromApi($photoSizes)
            )
        );
    }
}