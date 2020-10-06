<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;
use TelegramPro\Bot\Types\LivePeriodIsNotValid;

final class PollCloseDate extends IntegerObject
{
    public static function nowPlusSeconds(int $seconds)
    {
        return new static(time() + $seconds);
    }
    
    public static function fromInt(?int $integer): ?self
    {
        if ( ! is_integer($integer)) {
            return null;
        }
    
        $low = time() + 5;
        $high = time() + 600;
        
        if ($integer > $high || $integer < $low) {
            throw new LivePeriodIsNotValid("Poll close date must be between 5 and 600 seconds into the future.");
        }

        return new static($integer);
    }
}