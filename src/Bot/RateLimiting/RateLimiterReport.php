<?php namespace TelegramPro\Bot\RateLimiting;

final class RateLimiterReport
{

    public function __construct(
        private int $numberOfTelegramForcedThrottleDelays,
        private float $totalSecondsOfRateLimitedThrottleDelay,
        private float $totalSecondsOfTelegramForcedThrottleDelay
    ) {
    }

    public function numberOfTelegramForcedThrottleDelays(): int
    {
        return $this->numberOfTelegramForcedThrottleDelays;
    }

    public function totalSecondsOfRateLimitedThrottleDelay(): float
    {
        return $this->totalSecondsOfRateLimitedThrottleDelay;
    }

    public function totalSecondsOfTelegramForcedThrottleDelay(): float
    {
        return $this->totalSecondsOfTelegramForcedThrottleDelay;
    }
}