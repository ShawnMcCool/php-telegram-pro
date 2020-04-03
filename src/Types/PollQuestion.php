<?php namespace TelegramPro\Types;

/**
 * Poll question, 1-255 characters
 */
final class PollQuestion implements ApiReadType
{
    private string $question;

    private function __construct(string $question)
    {
        $this->question = $question;
    }

    public function toString(): string
    {
        return $this->question;
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($question): ?self
    {
        if (is_null($question)) {
            return null;
        }

        if (strlen($question) > 255) {
            throw new PollQuestionTextIsTooLong("Poll Question text '{$question}' can not be longer than 255 characters.");
        }

        return new static($question);
    }
}