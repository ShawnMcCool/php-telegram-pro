<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

final class ArrayOfStrings extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): static
    {
        return new static(
            collect($items)
        );
    }
}