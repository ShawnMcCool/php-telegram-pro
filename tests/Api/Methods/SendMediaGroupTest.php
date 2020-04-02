<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Url;
use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Video;
use TelegramPro\Types\Message;
use TelegramPro\Types\FilePath;
use TelegramPro\Types\PhotoSize;
use TelegramPro\Methods\SendPhoto;
use TelegramPro\Methods\SendVideo;
use TelegramPro\Methods\MediaGroup;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;
use TelegramPro\Methods\SendMediaGroup;
use TelegramPro\Methods\FileUploads\VideoFile;
use TelegramPro\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Methods\FileUploads\InputMediaPhoto;
use TelegramPro\Methods\FileUploads\InputMediaVideo;

class SendMediaGroupTest extends TelegramTestCase
{
    function testSendMediaGroupWithFilePath()
    {
        $sent = SendMediaGroup::parameters(
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

        $this->isOk($sent);
        self::assertCount(2, $sent->result());
        self::assertInstanceOf(Message::class, $sent->result()->get(0));
    }

    function testSendMediaGroupWithUrl()
    {
        $sent = SendMediaGroup::parameters(
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

        $this->isOk($sent);
        self::assertCount(2, $sent->result());
    }

    function testSendMediaGroupWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendPhoto::parameters(
            $this->config->chatId(),
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[SendMediaGroup] send media group with file id 1/4 ' . $num)
        )->send($this->telegram);

        /** @var PhotoSize $sentPhoto */
        $this->isOk($sent);
        $sentPhoto = $sent->result()->photo()[0];

        $sent = SendVideo::parameters(
            $this->config->chatId(),
            VideoFile::fromFilePath(
                FilePath::fromString($this->media->video())
            ),
            MediaCaption::fromString('[SendMediaGroup] send media group with file id 2/4 ' . $num)
        )->send($this->telegram);

        /** @var Video $sentPhoto */
        $this->isOk($sent);
        $sentVideo = $sent->result()->video();

        $sent = SendMediaGroup::parameters(
            $this->config->chatId(),
            MediaGroup::items(
                InputMediaPhoto::fromFileId(
                    $sentPhoto->fileId(),
                    MediaCaption::fromString('[SendMediaGroup] send media group with file id 3/4')
                ),
                InputMediaVideo::fromFileId(
                    $sentVideo->fileId(),
                    MediaCaption::fromString('[SendMediaGroup] send media group with file id 4/4')
                )
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertCount(2, $sent->result());
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
        $sent = SendMediaGroup::parameters(
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

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}