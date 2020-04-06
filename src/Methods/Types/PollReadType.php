<?php namespace TelegramPro\Methods\Types;

/**
 * Poll type, “quiz” or “regular”, defaults to “regular”
 */
final class PollReadType
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
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($type): self
    {
        if ( ! in_array($type, ['regular', 'quiz'])) {
            throw new PollTypeNotSupported($type);
        }

        return new static ($type);
    }
}