<?php namespace TelegramPro\Types;

/**
 * This object contains information about one answer option in a poll.
 */
final class PollOption
{
    private PollOptionText $text;
    private int $voterCount;

    public function __construct(
        PollOptionText $text,
        int $voterCount
    ) {
        $this->text = $text;
        $this->voterCount = $voterCount;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($option): PollOption
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