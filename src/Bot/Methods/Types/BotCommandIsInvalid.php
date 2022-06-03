<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\TelegramProException;

final class BotCommandIsInvalid extends \InvalidArgumentException implements TelegramProException
{
    public static function commandIsAnInvalidLength(string $command)
    {
        return new static('Bot command "' . $command . '" is an invalid length. Commands must be between 1 and 32 characters inclusive.');
    }

    public static function commandContainsInvalidCharacters(string $command)
    {
        return new static('Bot command "' . $command . '" contains invalid characters. Command can contain only lowercase English letters, digits and underscores.');
    }

    public static function descriptionIsAnInvalidLength(string $description)
    {
        return new static('Bot description "' . $description . '" is an invalid length. Descriptions must be between 3-256 characters inclusive.');
    }
}