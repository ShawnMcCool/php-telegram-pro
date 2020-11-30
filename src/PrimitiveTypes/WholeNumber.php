<?php namespace TelegramPro\PrimitiveTypes;

abstract class WholeNumber
{
    private int $number;

    private function __construct(int $number)
    {
        $this->number = $number;
    }

    public function toInteger(): int
    {
        return $this->number;
    }

    public function toString(): string
    {
        return (string) $this->number;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromInt(?int $integer): ?static
    {
        if (is_null($integer)) {
            return null;
        }

        if (($integer % 2) != 0) {
            throw new NonWholeNumberIsNotSupported($integer);
        }
        
        return new static($integer);
    }
}