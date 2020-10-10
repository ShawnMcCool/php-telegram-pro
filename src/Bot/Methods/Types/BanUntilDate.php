<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever
 */
final class BanUntilDate extends Date
{
    public static function forever()
    {
        return static::fromString('now');
    }
}