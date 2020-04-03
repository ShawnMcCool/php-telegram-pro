<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Unique query identifier
 */
final class ShippingQueryId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}