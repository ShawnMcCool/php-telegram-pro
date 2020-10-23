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
        $response = SendLocation::parameters(
            $this->config->validGroup(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testLivePeriodMustBeBetween60And864000()
    {
        $this->expectException(LivePeriodIsNotValid::class);

        SendLocation::parameters(
            $this->config->validGroup(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(32)
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendLocation::parameters(
            $this->config->validGroup(),
            Latitude::fromFloat(0.0),
            Longitude::fromFloat(180)
        )->send($this->telegram);
        
        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}