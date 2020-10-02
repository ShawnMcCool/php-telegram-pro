<?php namespace TelegramPro\Bot\Types;

/**
 * Contains multiple Passport Files
 */
final class ArrayOfPassportFiles extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfPassportFiles
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