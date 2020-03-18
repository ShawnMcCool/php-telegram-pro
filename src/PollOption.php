<?php namespace TelegramPro;

final class PollOption
***REMOVED***
    private string $text;
    private int $voterCount;

    public function __construct(
        string $text,
        int $voterCount
    ) ***REMOVED***
        $this->text = $text;
        $this->voterCount = $voterCount;
    ***REMOVED***

    public static function arrayFromRequest(?array $options): ?array
    ***REMOVED***
        if ( ! $options) return null;

        $optionArray = [];

        foreach ($options as $option) ***REMOVED***
            $optionArray[] = PollOption::fromRequest($option);
        ***REMOVED***

        return $optionArray;
    ***REMOVED***

    private static function fromRequest($option): PollOption
    ***REMOVED***
        return new static(
            $option->text,
            $option->voter_count
        );
    ***REMOVED***
***REMOVED***