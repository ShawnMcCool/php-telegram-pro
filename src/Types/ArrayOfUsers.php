<?php namespace TelegramPro\Types;

final class ArrayOfUsers extends ArrayOfItems
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