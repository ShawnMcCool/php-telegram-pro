<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\DeleteChatPhoto;
use TelegramPro\Bot\Methods\Types\MethodError;

class DeleteChatPhotoTest extends TelegramTestCase
{
    function testDeleteChatPhotoWithFilePath()
    {
        $response = DeleteChatPhoto::parameters(
            $this->config->chatId()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->chatPhotoWasDeleted());
    }

    function testCanParseError()
    {
        $response = DeleteChatPhoto::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}