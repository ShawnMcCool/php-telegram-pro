<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\PollOptionText;

/**
 * This object contains information about one answer option in a poll.
 */
final class PollOption implements ApiReadType
{
    private function __construct(
        private PollOptionText $text,
        private int $voterCount
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($option): static
    {
        return new static(
            PollOptionText::fromApi($option->text),
            $option->voter_count
        );
    }

    /**
     * Option text, 1-100 characters
     */
    public function text(): PollOptionText
    {
        return $this->text;
    }

    /**
     * Number of users that voted for this option
     */
    public function voterCount(): int
    {
        return $this->voterCount;
    }
}