<?php namespace TelegramPro\PrimitiveTypes;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

abstract class StringObject implements ApiReadType, ApiWriteType
{
    protected string $string;

    protected function __construct(string $string)
    {
        $this->string = $string;
    }

    public function toString(): string
    {
        return $this->string;
    }
    
    public static function fromString(?string $string): ?static
    {
        if (is_null($string)) {
            return null;
        }
        return new static($string);
    }

    public function toApi()
    {
        return $this->string;
    }

    public static function fromApi($string): ?static
    {
        if (is_null($string)) {
            return null;
        }
        
        return static::fromString($string);
    }
}