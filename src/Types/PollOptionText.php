<?php namespace TelegramPro\Types;

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