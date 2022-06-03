<?php namespace TelegramPro\Bot\Methods\Types;

use DateTimeZone;
use DateTimeInterface;
use DateTimeImmutable;


/**
 * Dates from the Telegram api are represented in Unix time.
 */
class Date implements ApiReadType, ApiWriteType
{
    private function __construct(
        private DateTimeInterface $dateTime
    ) {
    }

    public function toUnixTimestamp(): int
    {
        return $this->dateTime->format('U');
    }

    public function toDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    /**
     * Date Time string as recognized by PHP. For more see: https://www.php.net/strtotime
     *
     * Options include strings like:
     * "now"
     * "10 September 2000"
     * "+1 day"
     * "+1 week"
     * "+1 week 2 days 4 hours 2 seconds"
     * "next Thursday"
     * "last Monday"
     */
    public static function fromString(
        string $dateString,
        ?DateTimeZone $timeZone = null
    ): static {
        return new static(
            (new DateTimeImmutable())->setTimestamp(
                strtotime($dateString)
            )->setTimezone(
                $timeZone ?? new DateTimeZone('UTC')
            )
        );
    }

    public static function fromDateTime(DateTimeInterface $dateTime)
    {
        return new static($dateTime);
    }

    function toApi()
    {
        return $this->toUnixTimestamp();
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($timestamp): ?static
    {
        if ( ! $timestamp) {
            return null;
        }

        return new static(
            (new DateTimeImmutable())
                ->setTimestamp($timestamp)
                ->setTimezone(new DateTimeZone('UTC'))
        );
    }
}