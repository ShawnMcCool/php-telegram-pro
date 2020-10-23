<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetChatPhoto;
use TelegramPro\Bot\Methods\DeleteChatPhoto;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

class DeleteChatPhotoTest extends TelegramTestCase
{
    function testDeleteChatPhotoWithFilePath()
    {
        $chatId = $this->config->validGroup();
        
        SetChatPhoto::parameters(
            $chatId,
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            )
        )->send($this->telegram);
        
        $response = DeleteChatPhoto::parameters(
            $chatId
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