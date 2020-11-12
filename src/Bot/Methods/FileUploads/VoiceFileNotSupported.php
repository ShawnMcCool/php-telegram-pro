<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use TelegramPro\TelegramProException;

final class VoiceFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): self
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .OGG format.");
    }

    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}