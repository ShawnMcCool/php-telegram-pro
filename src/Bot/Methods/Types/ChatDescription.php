<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class ChatDescription extends StringObject
{
    public static function fromString(?string $string): ?self
    {
        if (is_null($string)) {
            return null;
        }

        if (strlen($string) < 1 || strlen($string) > 255) {
            throw new ChatDescriptionLengthIsInvalid("Chat descriptions must be 1-255 characters.");
        }

        return new static($string);
    }
}