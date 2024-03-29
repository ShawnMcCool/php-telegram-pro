<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\TelegramProException;

final class CanNotGroupMediaFiles extends \InvalidArgumentException implements TelegramProException
{
    public static function mediaFileNotSupported(string $class): static
    {
        return new static("{$class} not supported. Use InputMediaPhoto or InputMediaVideo");
    }

    public static function mediaGroupsMustHaveTwoOrMoreItems()
    {
        return new static("Media groups must contain two or more items.");
    }
}