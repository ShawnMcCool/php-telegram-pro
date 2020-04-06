<?php namespace TelegramPro\Types;

/**
 * Contains a list of users
 */
final class ArrayOfUsers extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    static function fromApi($items): ArrayOfUsers
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