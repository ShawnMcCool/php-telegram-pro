<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendVenue;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;

class SendVenueTest extends TelegramTestCase
{
    function testSendLocation()
    {
        $response = SendVenue::parameters(
            $this->config->validGroup(),
            $this->config->latitude(),
            $this->config->longitude(),
            'my cool venue',
            '123 road street'
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanParseError()
    {
        $response = SendVenue::parameters(
            $this->config->wrongGroupId(),
            $this->config->latitude(),
            $this->config->longitude(),
            '',
            '',
            '',
            ''
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}