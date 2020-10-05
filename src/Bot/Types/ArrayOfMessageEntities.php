<?php namespace TelegramPro\Bot\Types;

/**
 * Contains multiple message entities (which format text elements)
 */
final class ArrayOfMessageEntities extends ArrayOfApiTypes implements ApiReadType
{
    /**
     * @inheritDoc
     */
    public static function fromApi($items): ArrayOfMessageEntities
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