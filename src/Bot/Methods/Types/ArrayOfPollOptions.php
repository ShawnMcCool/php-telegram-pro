<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\PollOption;
use TelegramPro\Collections\Collection;
use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

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

    public static function list(PollOptionText ...$options): self
    {
        return new static(Collection::of($options));
    }

    function toApi()
    {
        $options = $this
            ->items
            ->map(
                fn(PollOptionText $option) => $option->toApi()
            )->toArray();

        return json_encode($options);
    }
}