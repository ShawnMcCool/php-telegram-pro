<?php namespace TelegramPro\Types;

use JsonSerializable;

/**
 * Caption for media (0-1024 characters)
 */
final class MediaCaption implements JsonSerializable, ApiReadType
{
    private string $caption;

    private function __construct(string $caption)
    {
        $this->caption = $caption;
    }

    public function toString(): string
    {
        return $this->caption;
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toString();
    }

    /**
     * Create a media caption.
     *
     * @param string $caption caption text for the media
     *
     * @return MediaCaption
     *
     * @throws MessageTextIsTooLong
     */
    public static function fromString(string $caption): MediaCaption
    {
        if (strlen($caption) > 1024) {
            throw new MessageTextIsTooLong("Media caption '{$caption}' can not be longer than 1024 bytes.");
        }
        return new static($caption);
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($caption): ?MediaCaption
    {
        if (is_null($caption)) {
            return null;
        }

        return static::fromString($caption);
    }
}