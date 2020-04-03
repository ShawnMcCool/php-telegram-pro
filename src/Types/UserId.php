<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

/**
 * Unique identifier for this user or bot
 */
final class UserId extends IntegerObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromInt($data);
    }
}