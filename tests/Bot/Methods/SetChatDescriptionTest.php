<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetChatDescription;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\ChatDescription;

class SetChatDescriptionTest extends TelegramTestCase
{
    function testSetChatPhotoWithFilePath()
    {
        $response = SetChatDescription::parameters(
            $this->config->chatId(),
            ChatDescription::fromString('This is a chat description.')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->chatDescriptionWasSet());
    }

    function testCanParseError()
    {
        $response = SetChatDescription::parameters(
            $this->config->wrongGroupId(),
            ChatDescription::fromString('This is a chat description.')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}