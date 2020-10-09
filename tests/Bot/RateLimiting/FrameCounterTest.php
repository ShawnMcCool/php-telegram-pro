<?php namespace Tests\Bot\RateLimiting;

use PHPUnit\Framework\TestCase;
use TelegramPro\Bot\RateLimiting\FrameCounter;

class FrameCounterTest extends TestCase
{
    function testCanDetermineHowLongToWait()
    {
        $timestamps = [
            1,
            2,
            3,
            1601752804,
            1601752805,
            1601752806,
            1601752807,
            1601752808,
            1601752809,
            1601752810,
            1601752811,
            1601752812,
            1601752813,
            1601752814,
            1601752815,
            1601752816,
            1601752817,
            1601752818,
            1601752819,
            1601752820,
            1601752821,
            1601752822,
            1601752823,
            1601752824,
            1601752825,
            1601752826,
            1601752827,
            1601752828,
            1601752829,
            1601752830,
            1601752831,
            1601752832,
            1601752833,
            1601752834,
            1601752835,
            1601752836,
            1601752837,
            1601752838,
            1601752839,
            1601752840,
            1601752841,
            1601752842,
            1601752843,
        ];

        #
        $timeframe = new FrameCounter();

        foreach ($timestamps as $timestamp) {
            $timeframe->add($timestamp);
        }

        self::assertSame(
            21.0,
            $timeframe->secondsUntilRateLimitClears(1601752843, 40)
        );

    }

    function testIdenticalNumberOfTimestampsTwo()
    {
        $timestamps = [
            1601752805,
            1601752806,
            1601752807,
            1601752808,
            1601752809,
        ];
        
        #
        $timeframe = new FrameCounter();
        
        self::assertEquals(
            0.0,
            $timeframe->secondsUntilRateLimitClears(1601752809, 10)
        );

    }
}
