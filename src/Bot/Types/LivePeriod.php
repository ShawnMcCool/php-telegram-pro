<?php namespace TelegramPro\Bot\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

final class LivePeriod extends IntegerObject
{
    public static function fromInt(?int $integer): ?static
    {
        if ( ! is_integer($integer)) {
            return null;
        }
        
        if ($integer < 60 || $integer > 86400) {
            throw new LivePeriodIsNotValid("Live period must be between 60 and 86400.");
        }

        return new static($integer);
    }
}