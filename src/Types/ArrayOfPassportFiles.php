<?php namespace TelegramPro\Types;

final class ArrayOfPassportFiles extends ArrayOfItems
{
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