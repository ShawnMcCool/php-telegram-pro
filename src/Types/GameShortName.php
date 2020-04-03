<?php namespace TelegramPro\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Optional. Short name of a Game to be returned, serves as the unique identifier for the game
 */
final class GameShortName extends StringObject implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
    }
}