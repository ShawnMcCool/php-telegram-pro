<?php namespace TelegramPro\Bot\Methods\Types;

use DateTimeImmutable;

/**
 * Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
 */
final class RestrictUntilDate extends Date
{
    public static function forever()
    {
        return static::fromString('now');
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($timestamp): ?self
    {
        if ( ! $timestamp) {
            return null;
        }

        return new static(
            (new DateTimeImmutable())->setTimestamp($timestamp)
        );
    }
}