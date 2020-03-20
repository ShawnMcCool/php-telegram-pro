<?php namespace TelegramPro\Types;

use TelegramPro\TelegramProException;

final class AudioFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath): self
    {
        return new static("{$filePath} is not in .MP3 or .M4A format.");
    }

    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}