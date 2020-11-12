<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\Update;
use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

/**
 * Contains a list of updates
 */
final class ArrayOfUpdates extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    static function fromApi($updates): ArrayOfUpdates
    {
        return new static(
            collect(
                $updates
            )->map(
                fn($update) => Update::fromApi($update)
            )
        );
    }
}