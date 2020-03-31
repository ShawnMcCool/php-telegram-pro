<?php namespace TelegramPro\Types;

/**
 * Poll option text, 1-100 characters
 */
final class PollOptionText
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

    /**
     * Construct with data received from the Telegram bot api.
     */
    public static function fromApi($pollOptionText): ?self
    {
        if (is_null($pollOptionText)) {
            return null;
        }

        if (empty($pollOptionText)) {
            throw new PollTextCanNotBeEmpty;
        }
        
        if (strlen($pollOptionText) > 100) {
            throw new PollOptionTextIsTooLong("Poll Option text '{$pollOptionText}' can not be longer than 100 characters.");
        }

        return new static($pollOptionText);
    }
}