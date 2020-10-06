<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * Contains multiple Messages
 */
final class ArrayOfMessages extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfMessages
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