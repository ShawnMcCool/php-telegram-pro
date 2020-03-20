<?php namespace TelegramPro\Types;

use TelegramPro\TelegramProException;

final class AnimationFileNotSupported extends TelegramProException
{
    public static function formatNotSupported(string $filePath, string $mimeType): self
    {
        return new static("'{$filePath}' is reporting '{$mimeType}' but we need .GIF or H.264/MPEG-4 AVC video format.");
    }

    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}