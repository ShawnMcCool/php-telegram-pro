<?php namespace TelegramPro\Types;

final class ArrayOfEncryptedPassportElements extends ArrayOfItems
{
    static function fromApi($items): ArrayOfEncryptedPassportElements
    {
        return new static(
            collect(
                $items
            )->map(
                fn($encryptedPassportElement) => EncryptedPassportElement::fromApi($encryptedPassportElement)
            )
        );
    }
}