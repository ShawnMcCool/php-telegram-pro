<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class ChatAdministratorCustomTitle extends StringObject
{
    public static function fromString(?string $string): ?self
    {
        if (is_null($string)) {
            return null;
        }

        if (strlen($string) < 0 || strlen($string) > 16) {
            throw new ChatAdministratorCustomTitleIsInvalid('A chat administrator custom title must be between 0-16 characters. Emojis are not allowed.');
        }

        return new static($string);
    }
}