<?php namespace TelegramPro\Types;

final class MessageText
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

    public static function fromApi(?string $text): ?self
    {
        if (is_null($text)) {
            return null;
        }

        return static::fromString($text);
    }

    public static function fromString(string $string): self
    {
        if (strlen($string) > 4096) {
            throw new MessageTextIsTooLong("Message text '{$string}' can not be longer than 4096 bytes.");
        }
        
        return new static($string);
    }
}