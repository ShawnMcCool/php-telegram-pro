<?php namespace TelegramPro\Types;

final class PollOption
{
    private string $text;
    private int $voterCount;

    public function __construct(
        string $text,
        int $voterCount
    ) {
        $this->text = $text;
        $this->voterCount = $voterCount;
    }

    public static function fromApi($option): PollOption
    {
        return new static(
            $option->text,
            $option->voter_count
        );
    }
}