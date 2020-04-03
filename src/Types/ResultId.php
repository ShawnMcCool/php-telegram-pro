<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * The unique identifier for the inline query result that was chosen
 */
final class ResultId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}