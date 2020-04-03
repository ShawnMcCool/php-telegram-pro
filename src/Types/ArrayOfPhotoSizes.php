<?php namespace TelegramPro\Types;

final class ArrayOfPhotoSizes extends ArrayOfApiTypes implements ApiReadType
{
    static function fromApi($items): ArrayOfPhotoSizes
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