<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Url;
use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Message;
use TelegramPro\Types\PhotoSize;
use TelegramPro\Methods\SendPhoto;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\MethodError;
use TelegramPro\Methods\FileUploads\FilePath;
use TelegramPro\Methods\FileUploads\CanNotOpenFile;
use TelegramPro\Methods\FileUploads\InputPhotoFile;

class SendPhotoTest extends TelegramTestCase
{
    function testSendPhotoWithFilePath()
    {
        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendPhoto] send photo with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }
    
    function testSendPhotoWithUrl()
    {
        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromUrl(
                Url::fromString('https://homepages.cae.wisc.edu/~ece533/images/boat.png')
            ),
            MediaCaption::fromString('[SendPhoto] send photo with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendPhotoWithFileId()
    {
        $num = rand(0, 32767);
        
        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendPhoto] send photo with file id 1/2 ' . $num)
        )->send($this->telegram);

        /** @var PhotoSize $photoSize */
        $photoSize = $sent->result()->photo()[0];

        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFileId($photoSize->fileId()),
            MediaCaption::fromString('[SendPhoto] send photo with file id 2/2 ' . $num)
        )->send($this->telegram);
        
        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendPhoto] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendPhoto] parse error test')
        )->send($this->telegram);
        
        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}