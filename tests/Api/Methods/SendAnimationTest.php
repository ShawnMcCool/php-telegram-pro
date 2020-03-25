<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Message;
use TelegramPro\Types\AnimationFile;
use TelegramPro\Methods\SendAnimation;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;

class SendAnimationTest extends TelegramTestCase
{
    function testSendAnimationWithFilePath()
    {
        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromFile($this->media->animation()),
            Text::plain('[SendAnimation] send animation with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAnimationWithUrl()
    {
        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromUrl($this->media->animationUrl()),
            Text::plain('[SendAnimation] send animation with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAnimationWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromUrl($this->media->animationUrl()),
            Text::plain('[SendAnimation] send animation with file id 1/2 ' . $num)
        )->send($this->telegram);

        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromFileId(
                $sent->result()->animation()->fileId()
            ),
            Text::plain('[SendAnimation] send animation with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromFile('non existent file'),
            Text::plain('[SendAnimation] file does not exist error')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendAnimation::parameters(
            $this->config->groupId(),
            AnimationFile::fromUrl('https://bob'),
            Text::plain('[SendAnimation] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}