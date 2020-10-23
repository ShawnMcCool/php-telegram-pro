<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class SendMessageTest extends TelegramTestCase
{
    function testSendMessage()
    {
        $response = SendMessage::parameters(
            $this->config->validGroup(),
            MessageText::fromString('[SendMessage] send message')
        )->send($this->telegram);

        $this->isOk($response);

        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->validGroup(),
            MessageText::fromString('[SendMessage] send *markdown parsed* message')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanParseError()
    {
        $response = SendMessage::parameters(
            $this->config->wrongGroupId(),
            MessageText::fromString('[SendMessage] can parse error')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
