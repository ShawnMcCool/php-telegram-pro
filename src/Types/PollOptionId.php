<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

/**
 * Unique id for a poll option
 */
final class PollOptionId extends IntegerObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromInt($data);
    }
}