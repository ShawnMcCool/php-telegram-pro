<?php namespace TelegramPro\PrimitiveTypes;

abstract class IntegerObject
{
    private int $integer;

    private function __construct(int $integer)
    {
        $this->integer = $integer;
    }

    public function toInteger(): int
    {
        return $this->integer;
    }

    public function toString(): string
    {
        return (string)$this->integer;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
    
    public static function fromInt(?int $integer): ?self
    {
        if (is_null($integer)) {
            return null;
        }

        return new static($integer);
    }
}