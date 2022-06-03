<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\TelegramProException;

final class CanNotOpenFile extends \InvalidArgumentException implements TelegramProException
{
    public static function fileDoesNotExist($filePath): CanNotOpenFile
    {
        return new static("Can not open file '{$filePath}'.");
    }
}