<?php namespace TelegramPro\Bot\RateLimiting;

use TelegramPro\Collections\Collection;

/**
 * A collection of timestamps
 */
final class FrameCounter
{
    private Collection $timestamps;

    public function __construct()
    {
        $this->timestamps = Collection::empty();
    }

    public function add($microtime = null)
    {
        if (is_null($microtime)) $microtime = microtime(true);
        $this->timestamps = $this->timestamps->add($microtime);
    }

    public function secondsUntilRateLimitClears(int $currentTime, int $maxTimestampsInOneMinute): float
    {
        $periodStartTime = $currentTime - 60;

        if ($this->isUnderMaximumTimestamps($this->timestamps, $maxTimestampsInOneMinute, $currentTime)) {
            return 0;
        }

        $timestamps = $this->timestamps
            ->slice(-$maxTimestampsInOneMinute);

        $oldestTimestamp = null;

        while ( ! $this->isUnderMaximumTimestamps($timestamps, $maxTimestampsInOneMinute, $currentTime)) {
            $oldestTimestamp = $timestamps->head();
            $timestamps = $timestamps->tail();
        }

        return $oldestTimestamp - $periodStartTime;
    }

    private function isUnderMaximumTimestamps(Collection $timestamps, int $maxTimestampsInOneMinute, $currentTime): bool
    {
        return $timestamps
                ->filter(
                    fn($timestamp) => $timestamp >= $currentTime - 60
                )->count() < $maxTimestampsInOneMinute;
    }
}