<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Caption for media (0-1024 characters)
 */
final class MediaCaption extends StringObject
{
    /**
     * Create a media caption.
     *
     * @param string $caption caption text for the media
     *
     * @return MediaCaption
     *
     * @throws MessageTextIsTooLong
     */
    public static function fromString(?string $string): MediaCaption
    {
        if (strlen($string) > 1024) {
            throw new MessageTextIsTooLong("Media caption '{$string}' can not be longer than 1024 bytes.");
        }
        return new static($string);
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($caption): ?MediaCaption
    {
        if (is_null($caption)) {
            return null;
        }

        return new static($caption);
    }
}