<?php namespace TelegramPro\Types;

final class ArrayOfUsers extends ArrayOfApiTypes implements ApiReadType
{
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