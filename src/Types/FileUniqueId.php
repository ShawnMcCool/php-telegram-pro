<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Unique identifier for a file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 */
final class FileUniqueId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}