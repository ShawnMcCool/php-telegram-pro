<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class VoiceFileNotSupported extends \InvalidArgumentException implements TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): static
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .OGG format.");
    }

    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}