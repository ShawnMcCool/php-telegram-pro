<?php namespace TelegramPro\Bot\Types;

/**
 * Contains a list of poll options
 */
final class ArrayOfPollOptions extends ArrayOfApiTypes implements ApiReadType
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
}