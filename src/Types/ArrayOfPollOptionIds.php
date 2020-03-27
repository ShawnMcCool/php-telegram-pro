<?php namespace TelegramPro\Types;

final class ArrayOfPollOptionIds extends ArrayOfItems
{
    static function fromApi($items): ArrayOfPollOptionIds
    {
        return new static(
            collect(
                $items
            )->map(
                fn($pollOptionId) => PollOptionId::fromInt($pollOptionId)
            )
        );
    }
}