<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendPhoto;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

class SendPhotoTest extends TelegramTestCase
{
    function testSendPhotoWithFilePath()
    {
        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendPhoto] send photo with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }
    
    function testSendPhotoWithUrl()
    {
        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromUrl(
                Url::fromString('https://homepages.cae.wisc.edu/~ece533/images/boat.png')
            ),
            MediaCaption::fromString('[SendPhoto] send photo with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendPhotoWithFileId()
    {
        $num = rand(0, 32767);
        
        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendPhoto] send photo with file id 1/2 ' . $num)
        )->send($this->telegram);

        /** @var PhotoSize $photoSize */
        $photoSize = $response->sentMessage()->photo()[0];

        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromFileId($photoSize->fileId()),
            MediaCaption::fromString('[SendPhoto] send photo with file id 2/2 ' . $num)
        )->send($this->telegram);
        
        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendPhoto] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendPhoto::parameters(
            $this->config->supergroupChatId(),
            InputPhotoFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendPhoto] parse error test')
        )->send($this->telegram);
        
        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}