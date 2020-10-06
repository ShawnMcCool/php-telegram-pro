<?php namespace TelegramPro\PrimitiveTypes;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

abstract class FloatObject implements ApiReadType, ApiWriteType
{
    private int $float;

    protected function __construct(float $float)
    {
        $this->float = $float;
    }

    public function toFloat(): float
    {
        return $this->float;
    }

    public function toString(): string
    {
        return (string) $this->float;
    }

    public function toApi()
    {
        return $this->float;
    }

    public static function fromFloat(?float $float): ?self
    {
        if ( ! is_float($float)) {
            return null;
        }

        return new static($float);
    }

    public static function fromApi($float): ?self
    {
        return static::fromFloat($float);
    }
}