<?php namespace TelegramPro\Bot\Types;

use TelegramPro\PrimitiveTypes\FloatObject;

final class Longitude extends FloatObject
{
    public static function fromFloat(?float $float): ?self
    {
        if ( ! is_float($float)) {
            return null;
        }
        
        if ($float < -180 || $float > 180) {
            throw new LongitudeIsInvalid("Longitudes must be between -180 and 180 degrees.");
        }

        return new static($float);
    }
}