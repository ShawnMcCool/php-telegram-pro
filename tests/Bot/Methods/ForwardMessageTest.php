<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\ForwardMessage;
use TelegramPro\Bot\Methods\Types\MessageText;

class ForwardMessageTest extends TelegramTestCase
{
    function testCanForwardMessage()
    {
        $messageText = '[ForwardMessage] can forward message ' . rand(0, 32767);

        $response = SendMessage::parameters(
            $this->config->chatId(),
            MessageText::fromString($messageText)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());

        $forwarded = ForwardMessage::parameters(
            $this->config->chatId(),
            $this->config->chatId(),
            $response->sentMessage()->messageId()
        )->send($this->telegram);

        $this->isOk($forwarded);
        self::assertInstanceOf(Message::class, $forwarded->sentMessage());
        self::assertSame($messageText, $forwarded->sentMessage()->text());
    }
}
