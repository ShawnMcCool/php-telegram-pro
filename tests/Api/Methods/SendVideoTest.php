<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Methods\Types\Url;
use TelegramPro\Methods\SendVideo;
use TelegramPro\Methods\MethodError;
use TelegramPro\Methods\Types\MediaCaption;
use TelegramPro\Methods\FileUploads\FilePath;
use TelegramPro\Methods\FileUploads\VideoFile;
use TelegramPro\Methods\FileUploads\CanNotOpenFile;

class SendVideoTest extends TelegramTestCase
{
    function testSendVideoWithFilePath()
    {
        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromFilePath(
                FilePath::fromString($this->media->video())
            ),
            MediaCaption::fromString('[SendVideo] send video with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVideoWithUrl()
    {
        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromUrl(
                Url::fromString($this->media->videoUrl())
            ),
            MediaCaption::fromString('[SendVideo] send video with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVideoWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromUrl(
                Url::fromString($this->media->videoUrl())
            ),
            MediaCaption::fromString('[SendVideo] send video with file id 1/2 ' . $num)
        )->send($this->telegram);
        
        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromFileId(
                $sent->result()->video()->fileId()
            ),
            MediaCaption::fromString('[SendVideo] send video with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendVideo] file does not exist error')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendVideo] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}