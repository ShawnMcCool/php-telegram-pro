<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Unique poll identifier
 */
final class PollId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}