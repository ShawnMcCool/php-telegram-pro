<?php namespace TelegramPro\Types;

/**
 * Poll type, “quiz” or “regular”, defaults to “regular”
 */
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

    /**
     * Construct with data received from the Telegram bot api.
     */
    public static function fromApi(string $type)
    {
        if ( ! in_array($type, ['regular', 'quiz'])) {
            throw new PollTypeNotSupported($type);
        }

        return new static ($type);
    }
}