<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\ForwardMessage;
use TelegramPro\Bot\Methods\Types\MessageText;

class ForwardMessageTest extends TelegramTestCase
{
    function testForwardMessage()
    {
        $messageText = '[ForwardMessage] can forward message ' . rand(0, 32767);

        $sent = SendMessage::parameters(
            $this->config->chatId(),
            MessageText::fromString($messageText)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());

        $forwarded = ForwardMessage::parameters(
            $this->config->chatId(),
            $this->config->chatId(),
            $sent->botInformation()->messageId()
        )->send($this->telegram);

        $this->isOk($forwarded);
        self::assertInstanceOf(Message::class, $forwarded->botInformation());
        self::assertSame($messageText, $forwarded->botInformation()->text());
    }
}
