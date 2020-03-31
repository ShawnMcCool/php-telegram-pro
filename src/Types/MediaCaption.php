<?php namespace TelegramPro\Types;

use JsonSerializable;

/**
 * Caption for media 0-1024 characters
 */
final class MediaCaption implements JsonSerializable
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

    public static function fromString(string $caption): MediaCaption
    {
        if (strlen($caption) > 1024) {
            throw new MessageTextIsTooLong("Media caption '{$caption}' can not be longer than 1024 bytes.");
        }
        return new static($caption);
    }

    public static function fromApi(?string $caption): ?MediaCaption
    {
        if (is_null($caption)) {
            return null;
        }

        return static::fromString($caption);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toString();
    }
}