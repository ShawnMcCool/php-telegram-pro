<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Collections\Collection;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

/**
 * Contains a list of poll options
 */
final class ArrayOfPollOptions extends ArrayOfApiTypes implements ApiReadType, ApiWriteType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfPollOptions
    {
        return new static(
            collect(
                $items
            )->map(
                fn($pollOption) => PollOption::fromApi($pollOption)
            )
        );
    }

    public static function fromArray(array $pollOptions): self
    {
        return new static(Collection::of($pollOptions));
    }
    
    function toApi()
    {
        return json_encode($this->items->toArray());
    }
}