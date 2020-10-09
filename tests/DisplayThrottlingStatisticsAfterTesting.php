<?php namespace Tests;

use PhAnsi\Decoration\TextTable;
use PHPUnit\Runner\AfterLastTestHook;
use TelegramPro\Bot\RateLimiting\RateLimiterReport;

final class DisplayThrottlingStatisticsAfterTesting implements AfterLastTestHook
{
    public function executeAfterLastTest(): void
    {
        $telegram = TelegramTestCase::telegramInstance();
        
        if ( ! $telegram) {
            return;
        }
        
        /** @var RateLimiterReport $report */
        $report = $telegram->limiterReport();

        echo "\n\n" .
            TextTable::make()
                     ->withHeaders('Rate Limiting Report', '')
                     ->withRows(
                         [
                             ['seconds of rate limiting', (string) number_format($report->totalSecondsOfRateLimitedThrottleDelay(), 2)],
                             ['times Telegram force-throttled', $report->numberOfTelegramForcedThrottleDelays()],
                             ['seconds of forced throttling', (string) number_format($report->totalSecondsOfTelegramForcedThrottleDelay(), 2)],
                         ]
                     )->toString();
    }
}