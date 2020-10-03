<?php namespace TelegramPro\Bot\Types;

use TelegramPro\PrimitiveTypes\FloatObject;

final class Latitude extends FloatObject
{
    public static function fromFloat(?float $float): ?self
    {
        if ( ! is_float($float)) {
            return null;
        }
        
        if ($float > 90 || $float < -90) {
            throw new LatitudeIsInvalid("Latitudes must be between -90 and 90 degrees.");
        }

        return new static($float);
    }
}