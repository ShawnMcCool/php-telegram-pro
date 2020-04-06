<?php namespace TelegramPro\Types;

use JsonSerializable;
use TelegramPro\PrimitiveTypes\StringObject;

abstract class ApiReadString extends StringObject implements JsonSerializable, ApiReadType
{
    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($text): ?self
    {
        if (is_null($text)) {
            return null;
        }

        return new static($text);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toString();
    }
}