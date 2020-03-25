<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\Text;
use TelegramPro\Types\PhotoFile;
use TelegramPro\Types\PhotoSize;
use TelegramPro\Types\MediaGroup;
use TelegramPro\Methods\SendPhoto;
use TelegramPro\Types\InputMediaPhoto;
use TelegramPro\Types\InputMediaVideo;
use TelegramPro\Methods\SendMediaGroup;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;

class SendMediaGroupTest extends TelegramTestCase
{
    function testSendMediaGroupWithFilePath()
    {
        $sent = SendMediaGroup::parameters(
            $this->config->groupId(),
            MediaGroup::items(
                InputMediaPhoto::fromFile($this->media->image(), Text::plain('[SendMediaGroup] send image with file path')),
                InputMediaVideo::fromFile($this->media->video(), Text::plain('[SendMediaGroup] send video with file path'))
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertIsArray($sent->result());
    }
    
    function testSendMediaGroupWithUrl()
    {
        $sent = SendMediaGroup::parameters(
            $this->config->groupId(),
            MediaGroup::items(
                InputMediaPhoto::fromUrl($this->media->imageUrl(), Text::plain('[SendMediaGroup] send image with url')),
                InputMediaVideo::fromUrl($this->media->videoUrl(), Text::plain('[SendMediaGroup] send video with url'))
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertIsArray($sent->result());
    }

    function testSendMediaGroupWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendPhoto::parameters(
            $this->config->groupId(),
            PhotoFile::fromFile($this->media->image()),
            '[SendMediaGroup] send image with file id 1/2 ' . $num
        )->send($this->telegram);

        /** @var PhotoSize $photoSize */
        $photoSize = $sent->result()->photo()[0];

        $sent = SendMediaGroup::parameters(
            $this->config->groupId(),
            MediaGroup::items(
                InputMediaPhoto::fromFileId($photoSize->fileId(), Text::plain('[SendMediaGroup] send image with file id')),
                InputMediaVideo::fromFileId($photoSize->fileId(), Text::plain('[SendMediaGroup] send image with file id'))
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertIsArray($sent->result());
    }

//    function testCanNotSendNonExistentFile()
//    {
//        $this->expectException(CanNotOpenFile::class);
//
//        $sent = SendMediaGroup::parameters(
//            $this->config->groupId(),
//            PhotoFile::fromFile('non existent file'),
//            '[SendMediaGroup] parse error test'
//        )->send($this->telegram);
//    }
//
//    function testCanParseError()
//    {
//        $sent = SendMediaGroup::parameters(
//            $this->config->groupId(),
//            PhotoFile::fromUrl('https://bob'),
//            '[SendMediaGroup] parse error test'
//        )->send($this->telegram);
//
//        self::assertFalse($sent->ok());
//        self::assertInstanceOf(MethodError::class, $sent->error());
//        self::assertSame('400', $sent->error()->code());
//        self::assertNotEmpty($sent->error()->description());
//    }
}