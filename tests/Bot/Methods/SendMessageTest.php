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
            $this->config->chatId(),
            MessageText::fromString('[SendMessage] send message')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->botInformation());
    }

    function testSendMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->chatId(),
            MessageText::fromString('[SendMessage] send *markdown parsed* message')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->botInformation());
    }

    function testCanParseError()
    {
        $sent = SendMessage::parameters(
            $this->config->wrongGroupId(),
            MessageText::fromString('[SendMessage] can parse error')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}
