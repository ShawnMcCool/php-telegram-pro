<?php namespace TelegramPro\Bot\RateLimiting;

final class RateLimiterReport
{
    private int $numberOfTelegramForcedThrottleDelays;
    private float $totalSecondsOfRateLimitedThrottleDelay;
    private float $totalSecondsOfTelegramForcedThrottleDelay;

    public function __construct(
        int $numberOfTelegramForcedThrottleDelays,
        float $totalSecondsOfRateLimitedThrottleDelay,
        float $totalSecondsOfTelegramForcedThrottleDelay
    ) {
        $this->numberOfTelegramForcedThrottleDelays = $numberOfTelegramForcedThrottleDelays;
        $this->totalSecondsOfRateLimitedThrottleDelay = $totalSecondsOfRateLimitedThrottleDelay;
        $this->totalSecondsOfTelegramForcedThrottleDelay = $totalSecondsOfTelegramForcedThrottleDelay;
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