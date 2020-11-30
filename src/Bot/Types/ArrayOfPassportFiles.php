<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use function TelegramPro\collect;

/**
 * Contains multiple Passport Files
 */
final class ArrayOfPassportFiles extends ArrayOfApiTypes implements ApiReadType
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
                fn($passportFile) => PassportFile::fromApi($passportFile)
            )
        );
    }
}