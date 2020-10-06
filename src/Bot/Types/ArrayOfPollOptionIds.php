<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\PollOptionId;

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