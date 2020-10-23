<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetChatTitle;
use TelegramPro\Bot\Methods\Types\ChatTitle;
use TelegramPro\Bot\Methods\Types\MethodError;

class SetChatTitleTest extends TelegramTestCase
{
    function testSetChatPhotoWithFilePath()
    {
        $response = SetChatTitle::parameters(
            $this->config->cyclingChatId(),
            ChatTitle::fromString('This is a chat.')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->chatTitleWasSet());
    }

    function testCanParseError()
    {
        $response = SetChatTitle::parameters(
            $this->config->wrongGroupId(),
            ChatTitle::fromString('This is a chat.')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}