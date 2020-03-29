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

        if (strlen($text) > 4096) {
            throw new MessageTextIsTooLong("Message text '{$text}' can not be longer than 4096 bytes.");
        }

        return new static($text);
    }
}