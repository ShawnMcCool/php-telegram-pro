<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use TelegramPro\TelegramProException;

final class VideoNoteFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): static
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .MP4 format.");
    }
}