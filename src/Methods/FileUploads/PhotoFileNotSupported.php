<?php namespace TelegramPro\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class PhotoFileNotSupported extends TelegramProException
{
    public static function fileSizeIsGreaterThan10Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 10 megabytes.");
    }
}