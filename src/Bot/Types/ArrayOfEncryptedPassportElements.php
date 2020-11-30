<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use function TelegramPro\collect;

/**
 * Contains multiple encrypted passport elements
 */
final class ArrayOfEncryptedPassportElements extends ArrayOfApiTypes implements ApiReadType
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
                fn($encryptedPassportElement) => EncryptedPassportElement::fromApi($encryptedPassportElement)
            )
        );
    }
}