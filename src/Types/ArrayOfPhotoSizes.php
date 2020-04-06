<?php namespace TelegramPro\Types;

/**
 * Contains a list of available photo sizes for a single photo
 */
final class ArrayOfPhotoSizes extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfPhotoSizes
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