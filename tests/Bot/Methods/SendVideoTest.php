<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendVideo;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\VideoFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;

class SendVideoTest extends TelegramTestCase
{
    function testSendVideoWithFilePath()
    {
        $response = SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromFilePath(
                FilePath::fromString($this->media->video())
            ),
            MediaCaption::fromString('[SendVideo] send video with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendVideoWithUrl()
    {
        $response = SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromUrl(
                Url::fromString($this->media->videoUrl())
            ),
            MediaCaption::fromString('[SendVideo] send video with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendVideoWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromUrl(
                Url::fromString($this->media->videoUrl())
            ),
            MediaCaption::fromString('[SendVideo] send video with file id 1/2 ' . $num)
        )->send($this->telegram);
        
        $response = SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromFileId(
                $response->sentMessage()->video()->fileId()
            ),
            MediaCaption::fromString('[SendVideo] send video with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendVideo] file does not exist error')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendVideo::parameters(
            $this->config->supergroupChatId(),
            VideoFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendVideo] parse error test')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}