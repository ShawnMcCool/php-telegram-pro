<?php namespace TelegramPro\Types;

final class ArrayOfMessages extends ArrayOfApiTypes implements ApiReadType
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