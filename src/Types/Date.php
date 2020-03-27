<?php namespace TelegramPro\Types;

use DateTimeImmutable;

final class Date
{
    private DateTimeImmutable $dateTime;

    private function __construct(DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function toUnixTimestamp(): int
    {
        return $this->dateTime->format('U');
    }

    public function toDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public static function fromApi($timestamp): ?Date
    {
        if ( ! $timestamp) {
            return null;
        }
        
        return new static(
            (new DateTimeImmutable())->setTimestamp($timestamp)
        );
    }
}