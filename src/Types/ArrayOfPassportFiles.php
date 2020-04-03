<?php namespace TelegramPro\Types;

final class ArrayOfPassportFiles extends ArrayOfApiTypes implements ApiReadType
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