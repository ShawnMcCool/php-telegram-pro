<?php namespace TelegramPro\Bot\Types;

/**
 * Contains a list of poll options identifiers
 */
final class ArrayOfPollOptionIds extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfPollOptionIds
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