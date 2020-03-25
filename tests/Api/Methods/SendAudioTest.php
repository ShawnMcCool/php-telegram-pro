<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Message;
use TelegramPro\Types\AudioFile;
use TelegramPro\Methods\SendAudio;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;

class SendAudioTest extends TelegramTestCase
{
    function testSendAudioFileWithFilePath()
    {
        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFile($this->media->mp3()),
            Text::plain('[SendAudio] send audio with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithUrl()
    {
        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromUrl($this->media->audioUrl()),
            Text::plain('[SendAudio] send audio with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFile($this->media->mp3()),
            Text::plain('[SendAudio] send audio with file id 1/2 ' . $num)
        )->send($this->telegram);

        $audioId = $sent->result()->audio()->fileId();

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFileId($audioId),
            Text::plain('[SendAudio] send audio with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFile('non existent file'),
            Text::plain('[SendAudio] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromUrl('https://bob'),
            Text::plain('[SendAudio] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}