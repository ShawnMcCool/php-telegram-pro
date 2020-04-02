<?php namespace TelegramPro\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class DocumentFileNotSupported extends TelegramProException
{
    public static function fileSizeIsGreaterThan50Megabyte(string $filePath)
    {
        return new static("{$filePath} is greater than 50 megabytes.");
    }
}