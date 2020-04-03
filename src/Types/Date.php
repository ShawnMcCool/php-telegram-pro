<?php namespace TelegramPro\Types;

use DateTimeImmutable;

/**
 * Dates from the Telegram api are represented in Unix time.
 */
final class Date implements ApiReadType
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
    
    /**
     * @internal Construct with data received from the Telegram bot api.
     */
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