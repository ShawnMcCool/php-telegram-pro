<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class InlineQueryId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}