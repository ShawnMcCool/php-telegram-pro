<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Seconds;

/**
 * Contains information about why a request was unsuccessful.
 */
final class ResponseParameters
{
    private ?ChatId $migrateToChatId;
    private Seconds $retryAfter;

    public function __construct(
        ?ChatId $migrateToChatId,
        Seconds $retryAfter
    ) {
        $this->migrateToChatId = $migrateToChatId;
        $this->retryAfter = $retryAfter;
    }

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public function migrateToChatId(): ?ChatId
    {
        return $this->migrateToChatId;
    }

    /**
     * Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
     */
    public function retryAfter(): Seconds
    {
        return $this->retryAfter;
    }
}