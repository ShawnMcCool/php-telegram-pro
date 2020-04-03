<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Unique message identifier inside a chat
 */
final class MessageId extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}