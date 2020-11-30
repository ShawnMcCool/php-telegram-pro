<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

/**
 * Contains a list of chat members
 */
final class ArrayOfChatMembers extends ArrayOfApiTypes implements ApiReadType
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
                fn($user) => ChatMember::fromApi($user)
            )
        );
    }
}