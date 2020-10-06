<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendPoll;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Types\ArrayOfPollOptions;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\PhoneNumber;

class SendPollTest extends TelegramTestCase
{
    function testSendPoll()
    {
        $response = SendPoll::parameters(
            $this->config->chatId(),
            'Is this a poll?',
            ArrayOfPollOptions::fromArray(
                [
                    'yes', 'no', 'maybe',
                ]
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanParseError()
    {
        $response = SendPoll::parameters(
            $this->config->wrongGroupId(),
            'Is this a poll?',
            ArrayOfPollOptions::fromArray(
                [
                    'yes', 'no', 'maybe',
                ]
            )
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}