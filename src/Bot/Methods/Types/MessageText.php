<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * The actual UTF-8 text of a message, 0-4096 characters
 */
final class MessageText implements ApiWriteType
{
    private function __construct(
        private string $text
    ) {
    }

    public function toString(): string
    {
        return $this->text;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    function toApi(?ParseMode $parseMode = null): string
    {
        if ($parseMode) {
            return $parseMode->escapeText($this->text);
        }
        return $this->text;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($text): ?static
    {
        if (is_null($text)) {
            return null;
        }

        return static::fromString($text);
    }

    /**
     * Construct message text from a string
     *
     * @param string $string
     * @return static
     * @throws MessageTextIsTooLong
     */
    public static function fromString(string $string): static
    {
        if (strlen($string) > 4096) {
            throw new MessageTextIsTooLong("Message text '{$string}' can not be longer than 4096 bytes.");
        }

        return new static($string);
    }
}