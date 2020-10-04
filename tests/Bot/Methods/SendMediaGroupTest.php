<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\Video;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendPhoto;
use TelegramPro\Bot\Methods\SendVideo;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\SendMediaGroup;
use TelegramPro\Bot\Methods\Types\MediaGroup;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\VideoFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\FileUploads\InputMediaPhoto;
use TelegramPro\Bot\Methods\FileUploads\InputMediaVideo;

class SendMediaGroupTest extends TelegramTestCase
{
    function testSendMediaGroupWithFilePath()
    {
        $response = SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromFilePath(
                    FilePath::fromString($this->media->image()),
                    MediaCaption::fromString('[SendMediaGroup] send image with file path')
                ),
                InputMediaVideo::fromFilePath(
                    FilePath::fromString($this->media->video()),
                    MediaCaption::fromString('[SendMediaGroup] send video with file path')
                )
            )
        )->send($this->telegram);

        $this->isOk($response);
        
        self::assertCount(2, $response->sentMessages());
        self::assertInstanceOf(Message::class, $response->sentMessages()->get(0));
    }

    function testSendMediaGroupWithUrl()
    {
        $response = SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromUrl(
                    Url::fromString($this->media->imageUrl()),
                    MediaCaption::fromString('[SendMediaGroup] send image with url')
                ),
                InputMediaVideo::fromUrl(
                    Url::fromString($this->media->videoUrl()),
                    MediaCaption::fromString('[SendMediaGroup] send video with url')
                )
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertCount(2, $response->sentMessages());
    }

    function testSendMediaGroupWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendMediaGroup] send media group with file id 1/4 ' . $num)
        )->send($this->telegram);

        /** @var PhotoSize $responsePhoto */
        $this->isOk($response);
        $responsePhoto = $response->sentMessage()->photo()[0];

        $response = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromFilePath(
                FilePath::fromString($this->media->video())
            ),
            MediaCaption::fromString('[SendMediaGroup] send media group with file id 2/4 ' . $num)
        )->send($this->telegram);

        /** @var Video $responsePhoto */
        $this->isOk($response);
        $responseVideo = $response->sentMessage()->video();

        $response = SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromFileId(
                    $responsePhoto->fileId(),
                    MediaCaption::fromString('[SendMediaGroup] send media group with file id 3/4')
                ),
                InputMediaVideo::fromFileId(
                    $responseVideo->fileId(),
                    MediaCaption::fromString('[SendMediaGroup] send media group with file id 4/4')
                )
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertCount(2, $response->sentMessages());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromFilePath(
                    FilePath::fromString('non existent file')
                ),
                InputMediaPhoto::fromFilePath(
                    FilePath::fromString('non existent file')
                )
            )
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromUrl(
                    Url::fromString('http://non.existent.url')
                ),
                InputMediaPhoto::fromUrl(
                    Url::fromString('http://non.existent.url')
                )
            )
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}