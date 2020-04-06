<?php namespace TelegramPro\PrimitiveTypes;

abstract class StringObject
{
    protected string $string;

    protected function __construct(string $string)
    {
        $this->string = $string;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->string;
    }

    public static function fromString(?string $string): ?self
    {
        if (is_null($string)) {
            return null;
        }
        return new static($string);
    }
}