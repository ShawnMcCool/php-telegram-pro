<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendPoll;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Types\ArrayOfPollOptions;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\PhoneNumber;
use TelegramPro\Bot\Methods\Types\PollOptionText;

class SendPollTest extends TelegramTestCase
{
    function testSendPoll()
    {
        $response = SendPoll::parameters(
            $this->config->chatId(),
            'Is this a poll?',
            ArrayOfPollOptions::list(
                PollOptionText::fromString('yes'),
                PollOptionText::fromString('no'),
                PollOptionText::fromString('maybe')
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
            ArrayOfPollOptions::list(
                PollOptionText::fromString('yes'),
                PollOptionText::fromString('no'),
                PollOptionText::fromString('maybe')
            )
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}