<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\LivePeriod;
use TelegramPro\Bot\Methods\SendLocation;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\StopMessageLiveLocation;

class StopMessageLiveLocationTest extends TelegramTestCase
{
    function testCanStopLiveLocation()
    {
        $locationResponse = SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(86400)
        )->send($this->telegram);

        $this->isOk($locationResponse);

        $stopLocationResponse = StopMessageLiveLocation::parameters(
            $this->config->chatId(),
            $locationResponse->sentMessage()->messageId()
        )->send($this->telegram);

        self::assertInstanceOf(Message::class, $stopLocationResponse->sentMessage());
    }

    function testCanParseError()
    {
        $response = SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90.0),
            Longitude::fromFloat(180),
            LivePeriod::fromInt(86400)
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}