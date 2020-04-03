<?php namespace TelegramPro\Types;

final class ArrayOfArrayOfPhotoSizes extends ArrayOfApiTypes implements ApiReadType
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