<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Methods\ParseMode;
use TelegramPro\Methods\SendMessage;
use TelegramPro\Methods\MethodError;

class SendMessageTest extends TelegramTestCase
{
    function testSendMessage()
    {
        $response = SendMessage::parameters(
            $this->config->groupId(),
            '[SendMessage] send message',
            ParseMode::none()
        )->send($this->telegramApi);

        self::assertTrue($response->ok());
        self::assertInstanceOf(Message::class, $response->result());
    }

    function testSendMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->groupId(),
            '[SendMessage] send *markdown parsed* message',
            ParseMode::markdown()
        )->send($this->telegramApi);

        self::assertTrue($response->ok());
        self::assertInstanceOf(Message::class, $response->result());
    }

    function testCanParseError()
    {
        $sent = SendMessage::parameters(
            $this->config->wrongGroupId(),
            '[SendMessage] can parse error',
            ParseMode::none()
        )->send($this->telegramApi);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}
