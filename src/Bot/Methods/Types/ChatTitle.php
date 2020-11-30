<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * New chat title, 1-255 characters
 */
final class ChatTitle extends StringObject
{
    public static function fromString(?string $string): ?static
    {
        if (is_null($string)) {
            return null;
        }

        if (strlen($string) < 1 || strlen($string) > 255) {
            throw new ChatTitleLengthIsInvalid("Chat titles must be 1-255 characters.");
        }

        return new static($string);
    }
}