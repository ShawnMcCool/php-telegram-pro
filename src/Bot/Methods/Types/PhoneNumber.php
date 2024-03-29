<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class PhoneNumber extends StringObject
{
    public static function fromString(?string $string): ?static
    {
        if (is_null($string)) {
            return null;
        }

        if ( ! \TelegramPro\string\starts_with($string, '+')) {
            throw new PhoneNumberIsNotValid("Phone numbers must be in valid E.164 format.");
        }

        return new static($string);
    }
}