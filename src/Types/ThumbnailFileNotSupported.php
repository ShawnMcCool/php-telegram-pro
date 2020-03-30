<?php namespace TelegramPro\Types;

use TelegramPro\TelegramProException;

final class ThumbnailFileNotSupported extends TelegramProException
{
    public static function fileSizeIsGreaterThan200Kilobytes(string $filePath): self
    {
        return new static("{$filePath} is greater than 200 kilobytes.");
    }

    public static function fileDimensionsAreNotValid($width, $height): self
    {
        return new static("Thumbnail width/height may not exceed 320x320 therefore '{$width}x{$height}' is invalid.");
    }

}