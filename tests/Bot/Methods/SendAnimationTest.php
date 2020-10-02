<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendAnimation;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\AnimationFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;

class SendAnimationTest extends TelegramTestCase
{
    function testSendAnimationWithFilePath()
    {
        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromFilePath(
                FilePath::fromString($this->media->animation())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendAnimationWithUrl()
    {
        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromUrl(
                Url::fromString($this->media->animationUrl())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendAnimationWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromUrl(
                Url::fromString($this->media->animationUrl())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file id 1/2 ' . $num)
        )->send($this->telegram);

        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromFileId(
                $sent->botInformation()->animation()->fileId()
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromFilePath(FilePath::fromString('non existent file')),
            MediaCaption::fromString('[SendAnimation] file does not exist error')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendAnimation::parameters(
            $this->config->chatId(),
            AnimationFile::fromUrl(Url::fromString('https://bob')),
            MediaCaption::fromString('[SendAnimation] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}