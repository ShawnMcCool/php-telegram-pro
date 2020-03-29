<?php namespace TelegramPro\Types;

final class ArrayOfArrayOfPhotoSizes extends ArrayOfItems
{
    static function fromApi($items): self
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