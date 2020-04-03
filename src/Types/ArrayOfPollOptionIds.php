<?php namespace TelegramPro\Types;

final class ArrayOfPollOptionIds extends ArrayOfApiTypes implements ApiReadType
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