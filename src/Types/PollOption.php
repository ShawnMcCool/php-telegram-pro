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

    public static function arrayfromApi(?array $options): ?array
    {
        if ( ! $options) return null;

        $optionArray = [];

        foreach ($options as $option) {
            $optionArray[] = PollOption::fromApi($option);
        }

        return $optionArray;
    }

    private static function fromApi($option): PollOption
    {
        return new static(
            $option->text,
            $option->voter_count
        );
    }
}