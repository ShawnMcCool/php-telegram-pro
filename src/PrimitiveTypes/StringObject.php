<?php namespace TelegramPro\PrimitiveTypes;

use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

abstract class StringObject implements ApiReadType, ApiWriteType
{

    protected function __construct(protected string $string)
    {
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

    function toApi(?ParseMode $parseMode = null): string
    {
        if ($parseMode) {
            return $parseMode->escapeText($this->string);
        }
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