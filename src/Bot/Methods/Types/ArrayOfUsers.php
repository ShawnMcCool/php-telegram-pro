<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

/**
 * Contains a list of users
 */
final class ArrayOfUsers extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    static function fromApi($items): static
    {
        return new static(
            collect(
                $items
            )->map(
                fn($user) => User::fromApi($user)
            )
        );
    }
}