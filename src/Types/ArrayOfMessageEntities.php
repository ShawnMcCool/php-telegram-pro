<?php namespace TelegramPro\Types;

final class ArrayOfMessageEntities extends ArrayOfApiTypes implements ApiReadType
{
    static function fromApi($items): ArrayOfMessageEntities
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