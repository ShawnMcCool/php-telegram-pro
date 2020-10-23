<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetChatPhoto;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

class SetChatPhotoTest extends TelegramTestCase
{
    function testSetChatPhotoWithFilePath()
    {
        $response = SetChatPhoto::parameters(
            $this->config->validGroup(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->profileChatWasSet());
    }

    function testCanParseError()
    {
        $response = SetChatPhoto::parameters(
            $this->config->wrongGroupId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            )
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}