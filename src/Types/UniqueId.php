<?php namespace TelegramPro\Types;

use Ramsey\Uuid\Uuid;

final class UniqueId
{
    private string $uuid;

    private function __construct(string $uuid)
    {
        $this->uuid = $uuid;
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