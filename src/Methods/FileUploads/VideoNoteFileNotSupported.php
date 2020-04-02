<?php namespace TelegramPro\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class VideoNoteFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): self
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .MP4 format.");
    }
}