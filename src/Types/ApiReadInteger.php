<?php namespace TelegramPro\Types;

use JsonSerializable;
use TelegramPro\PrimitiveTypes\IntegerObject;

abstract class ApiReadInteger extends IntegerObject implements JsonSerializable, ApiReadType
{
    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toInteger();
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($int): ?self
    {
        if (is_null($int)) {
            return null;
        }

        return static::fromInt($int);
    }
}