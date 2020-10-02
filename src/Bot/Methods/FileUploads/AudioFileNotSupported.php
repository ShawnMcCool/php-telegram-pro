<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class AudioFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): self
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .MP3 or .M4A format.");
    }

    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}