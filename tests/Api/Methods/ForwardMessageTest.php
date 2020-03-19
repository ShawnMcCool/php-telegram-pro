<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Message;
use TelegramPro\Methods\ParseMode;
use TelegramPro\Methods\SendMessage;
use TelegramPro\Methods\ForwardMessage;

class ForwardMessageTest extends MethodTestCase
{
    function testForwardMessage()
    {
        $messageText = '[ForwardMessage] can forward message ' . rand(0, 32767);

        $sent = SendMessage::parameters(
            $this->config->groupId(),
            $messageText,
            ParseMode::none()
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
        
        $forwarded = ForwardMessage::parameters(
            $this->config->groupId(),
            $this->config->groupId(),
            $sent->result()->messageId()
        )->send($this->telegramApi);
        
        self::assertTrue($forwarded->ok());
        self::assertInstanceOf(Message::class, $forwarded->result());
        self::assertSame($messageText, $forwarded->result()->text());
    }
}
