<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\InputFile;
use TelegramPro\Types\PhotoSize;
use TelegramPro\Methods\SendPhoto;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;

class SendPhotoTest extends TelegramTestCase
{
    function testSendPhotoWithFilePath()
    {
        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromFile($this->media->image()),
            '[SendPhoto] send photo with file path'
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }
    
    function testSendPhotoWithUrl()
    {
        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromUrl('https://homepages.cae.wisc.edu/~ece533/images/boat.png'),
            '[SendPhoto] send photo with url'
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendPhotoWithFileId()
    {
        $num = rand(0, 32767);
        
        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromFile($this->media->image()),
            '[SendPhoto] send photo with file id 1/2 ' . $num
        )->send($this->telegramApi);

        /** @var PhotoSize $photoSize */
        $photoSize = $sent->result()->photo()[0];

        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromFileId($photoSize->fileId()),
            '[SendPhoto] send photo with file id 2/2 ' . $num
        )->send($this->telegramApi);
        
        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromFile('non existent file'),
            '[SendPhoto] parse error test'
        )->send($this->telegramApi);
    }

    function testCanParseError()
    {
        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            InputFile::fromUrl('https://bob'),
            '[SendPhoto] parse error test'
        )->send($this->telegramApi);
        
        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}