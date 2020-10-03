<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\LivePeriod;
use TelegramPro\Bot\Methods\SendLocation;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Types\LivePeriodIsNotValid;

class SendLocationTest extends TelegramTestCase
{
    function testSendLocation()
    {
        $sent = SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(86400)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testLivePeriodMustBeBetween60And864000()
    {
        $this->expectException(LivePeriodIsNotValid::class);

        SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(32)
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(60)
        )->send($this->telegram);
        
        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}