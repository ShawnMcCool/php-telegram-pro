<?php namespace TelegramPro\Types;

final class ArrayOfMessages extends ArrayOfItems
{
    static function fromApi($items): ArrayOfMessages
    {
        return new static(
            collect(
                $items
            )->map(
                fn($message) => Message::fromApi($message)
            )
        );
    }
}