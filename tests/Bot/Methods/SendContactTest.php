<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\ChatId;
use TelegramPro\Bot\Types\Latitude;
use TelegramPro\Bot\Types\Longitude;
use TelegramPro\Bot\Methods\SendVenue;
use TelegramPro\Bot\Methods\SendContact;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\PhoneNumber;

class SendContactTest extends TelegramTestCase
{
    function testSendLocation()
    {
        $response = SendContact::parameters(
            $this->config->chatId(),
            PhoneNumber::fromString('+612341234'),
            'first name',
            'last name'
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanParseError()
    {
        $response = SendContact::parameters(
            $this->config->wrongGroupId(),
            PhoneNumber::fromString('+612341234'),
            'first name',
            'last name'
        )->send($this->telegram);


        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}