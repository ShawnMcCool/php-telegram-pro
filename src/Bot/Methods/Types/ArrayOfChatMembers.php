<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ArrayOfApiTypes;

/**
 * Contains a list of chat members
 */
final class ArrayOfChatMembers extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    static function fromApi($items): self
    {
        return new static(
            collect(
                $items
            )->map(
                fn($user) => ChatMember::fromApi($user)
            )
        );
    }
}