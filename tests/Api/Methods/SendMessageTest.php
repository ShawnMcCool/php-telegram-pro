<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Message;
use TelegramPro\Types\MessageText;
use TelegramPro\Methods\SendMessage;
use TelegramPro\Methods\MethodError;

class SendMessageTest extends TelegramTestCase
{
    function testSendMessage()
    {
        $response = SendMessage::parameters(
            $this->config->chatId(),
            MessageText::fromString('[SendMessage] send message')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->result());
    }

    function testSendMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->chatId(),
            MessageText::fromString('[SendMessage] send *markdown parsed* message')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->result());
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
