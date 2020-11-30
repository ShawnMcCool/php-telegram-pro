<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

final class PollOpenPeriod extends IntegerObject
{
    public static function fromInt(?int $integer): ?static
    {
        if ( ! is_integer($integer)) {
            return null;
        }

        if ($integer < 5 || $integer > 600) {
            throw new PollOpenPeriodIsNotValid("Live period must be between 5 and 600.");
        }

        return new static($integer);
    }
}