<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * Contains multiple encrypted passport elements
 */
final class ArrayOfEncryptedPassportElements extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfEncryptedPassportElements
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