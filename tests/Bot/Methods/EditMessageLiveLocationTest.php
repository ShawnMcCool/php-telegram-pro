<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Types\LivePeriod;
use TelegramPro\Bot\Methods\SendLocation;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\EditMessageLiveLocation;

class EditMessageLiveLocationTest extends TelegramTestCase
{
    function testCanStopLiveLocation()
    {
        $locationResponse = SendLocation::parameters(
            $this->config->chatId(),
            Latitude::fromFloat(90),
            Longitude::fromFloat(-180),
            LivePeriod::fromInt(400)
        )->send($this->telegram);

        $this->isOk($locationResponse);

        $editLocationResponse = EditMessageLiveLocation::parameters(
            Latitude::fromFloat(56.0),
            Longitude::fromFloat(78),
            $this->config->chatId(),
            $locationResponse->sentMessage()->messageId()
        )->send($this->telegram);
        
        self::assertSame(78, (int)$editLocationResponse->editedMessage()->location()->longitude());
        self::assertInstanceOf(Message::class, $editLocationResponse->editedMessage());
    }

    function testCanParseError()
    {
        $response = SendLocation::parameters(
            ChatId::fromInt(123),
            Latitude::fromFloat(90),
            Longitude::fromFloat(-180)
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}