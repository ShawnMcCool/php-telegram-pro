<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

final class UserProfilePhotoLimit extends IntegerObject
{
    public static function fromInt(?int $integer): ?self
    {
        if ( ! is_integer($integer)) {
            return null;
        }
        
        if ($integer > 100 || $integer < 1) {
            throw new UserProfilePhotoLimitIsInvalid('The user profile photo retrieval limit must be between 1-100 inclusive.');
        }
        
        return new static($integer);
    }
}