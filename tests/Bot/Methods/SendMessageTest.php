<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class SendMessageTest extends TelegramTestCase
{
    function testSendMessage()
    {
        $response = SendMessage::parameters(
            $this->config->cyclingChatId(),
            MessageText::fromString('[SendMessage] send message')
        )->send($this->telegram);

        $this->isOk($response);

        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendLegacyMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->cyclingChatId(),
            MessageText::fromString('[SendMessage] send markdown parsed message. *bold* _italic_ `inline fixed-width code`'),
            ParseMode::legacyMarkdown()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanSendMarkdownMessage()
    {
        $response = SendMessage::parameters(
            $this->config->cyclingChatId(),
            MessageText::fromString('[SendMessage] *bold \*text* send markdown parsed message\. *bold* _italic_ __underline__ ~strikethrough~ `inline fixed-width code`'),
            ParseMode::markdown()
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
