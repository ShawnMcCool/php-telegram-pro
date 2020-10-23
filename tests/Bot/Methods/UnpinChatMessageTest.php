<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\PinChatMessage;
use TelegramPro\Bot\Methods\UnpinChatMessage;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class UnpinChatMessageTest extends TelegramTestCase
{
    /**
     * @todo use getChat to test effects (not yet added)
     */
    function testSetChatPhotoWithFilePath()
    {
        $messageResponse = SendMessage::parameters(
            $this->config->supergroupChatId(),
            MessageText::fromString('this is a message to be pinned.')
        )->send($this->telegram);

        PinChatMessage::parameters(
            $this->config->supergroupChatId(),
            $messageResponse->sentMessage()->messageId()
        )->send($this->telegram);

        $response = UnpinChatMessage::parameters(
            $this->config->supergroupChatId()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->messageWasUnpinned());
    }

    function testCanParseError()
    {
        $response = UnpinChatMessage::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}