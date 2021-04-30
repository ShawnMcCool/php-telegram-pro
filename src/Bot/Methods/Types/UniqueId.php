<?php namespace TelegramPro\Bot\Methods\Types;

use Ramsey\Uuid\Uuid;

/**
 * Sometimes you just need a perfectly unique id.
 */
final class UniqueId
{
    private function __construct(
        private string $uuid
    ) {
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function new()
    {
        return new static(
            Uuid::uuid4()->toString()
        );
    }
}