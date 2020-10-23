<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendContact;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\PhoneNumber;

class SendContactTest extends TelegramTestCase
{
    function testSendLocation()
    {
        $response = SendContact::parameters(
            $this->config->cyclingChatId(),
            PhoneNumber::fromString('+612341234'),
            'first name',
            'last name'
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
        self::assertSame('+612341234', $response->sentMessage()->contact()->phoneNumber());
        self::assertSame('first name', $response->sentMessage()->contact()->firstName());
        self::assertSame('last name', $response->sentMessage()->contact()->lastName());
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