<?php namespace TelegramPro\Types;

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

    public static function arrayfromApi(?array $options): ?array
    ***REMOVED***
        if ( ! $options) return null;

        $optionArray = [];

        foreach ($options as $option) ***REMOVED***
            $optionArray[] = PollOption::fromApi($option);
        ***REMOVED***

        return $optionArray;
    ***REMOVED***

    private static function fromApi($option): PollOption
    ***REMOVED***
        return new static(
            $option->text,
            $option->voter_count
        );
    ***REMOVED***
***REMOVED***