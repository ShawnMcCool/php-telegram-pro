<?php namespace TelegramPro\Types;

use JsonSerializable;

/**
 * Text of the query (up to 256 characters)
 */
final class QueryText implements JsonSerializable
{
    private string $text;

    private function __construct(string $text)
    {
        $this->text = $text;
    }

    public function toString(): string
    {
        return $this->text;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function fromString(string $text): self
    {
        if (strlen($text) > 256) {
            throw new MessageTextIsTooLong("Query text '{$text}' can not be longer than 256 characters.");
        }
        return new static($text);
    }

    /**
     * Construct with data received from the Telegram bot api.
     */
    public static function fromApi(?string $text): ?self
    {
        if (is_null($text)) {
            return null;
        }

        return static::fromString($text);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toString();
    }
}