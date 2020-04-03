<?php namespace TelegramPro\Types;

final class ArrayOfPollOptions extends ArrayOfApiTypes implements ApiReadType
{
    static function fromApi($items): ArrayOfPollOptions
    {
        return new static(
            collect(
                $items
            )->map(
                fn($pollOption) => PollOption::fromApi($pollOption)
            )
        );
    }
}