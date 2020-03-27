<?php namespace TelegramPro\Types;

final class PollType
{
    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->type;
    }

    public static function fromString(string $type)
    {
        if ( ! in_array($type, ['regular', 'quiz'])) {
            throw new PollTypeNotSupported($type);
        }

        return new static ($type);
    }
}