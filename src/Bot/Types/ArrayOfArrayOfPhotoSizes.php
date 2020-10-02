<?php namespace TelegramPro\Bot\Types;

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