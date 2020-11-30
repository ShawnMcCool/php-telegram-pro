<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\MessageEntity;
use TelegramPro\Bot\Types\ArrayOfApiTypes;
use function TelegramPro\collect;

/**
 * Contains multiple message entities (which format text elements)
 */
final class ArrayOfMessageEntities extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): static
    {
        return new static(
            collect(
                $items
            )->map(
                fn($messageEntity) => MessageEntity::fromApi($messageEntity)
            )
        );
    }
}