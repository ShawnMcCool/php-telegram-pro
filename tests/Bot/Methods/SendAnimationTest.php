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
        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromFilePath(
                FilePath::fromString($this->media->animation())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendAnimationWithUrl()
    {
        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromUrl(
                Url::fromString($this->media->animationUrl())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendAnimationWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromUrl(
                Url::fromString($this->media->animationUrl())
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file id 1/2 ' . $num)
        )->send($this->telegram);

        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromFileId(
                $response->sentMessage()->animation()->fileId()
            ),
            MediaCaption::fromString('[SendAnimation] send animation with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromFilePath(FilePath::fromString('non existent file')),
            MediaCaption::fromString('[SendAnimation] file does not exist error')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendAnimation::parameters(
            $this->config->supergroupChatId(),
            AnimationFile::fromUrl(Url::fromString('https://bob')),
            MediaCaption::fromString('[SendAnimation] parse error test')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}