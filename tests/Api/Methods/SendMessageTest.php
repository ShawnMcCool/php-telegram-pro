<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Message;
use TelegramPro\Methods\ParseMode;
use TelegramPro\Methods\SendMessage;
use TelegramPro\Methods\MethodError;

class SendMessageTest extends MethodTestCase
{
    function testSendMessage()
    {
        $response = SendMessage::parameters(
            $this->config->groupId(),
            '[SendMessage] can send message',
            ParseMode::none()
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
