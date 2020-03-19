<?php namespace TelegramPro\Types;

use TelegramPro\TelegramProException;

final class CanNotOpenFile extends TelegramProException
{
    public static function fileDoesNotExist($filePath): CanNotOpenFile
    {
        return new static("Can not open file '{$filePath}'.");
    }
}