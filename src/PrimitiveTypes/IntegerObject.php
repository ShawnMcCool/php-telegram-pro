<?php namespace TelegramPro\PrimitiveTypes;

use TelegramPro\Bot\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

abstract class IntegerObject implements ApiReadType, ApiWriteType
{
    private int $integer;

    protected function __construct(int $integer)
    {
        $this->integer = $integer;
    }

    public function toInteger(): int
    {
        return $this->integer;
    }

    public function toString(): string
    {
        return (string) $this->integer;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toApi()
    {
        return $this->integer;
    }

    public static function fromInt(?int $integer): ?self
    {
        if ( ! is_integer($integer)) {
            return null;
        }

        return new static($integer);
    }

    public static function fromApi($int): ?self
    {
        return static::fromInt($int);
    }
}