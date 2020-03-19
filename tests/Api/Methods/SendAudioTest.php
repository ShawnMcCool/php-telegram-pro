<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\InputFile;
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
            '[SendAudio] send audio with file path'
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithUrl()
    {
        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromUrl($this->media->audioUrl()),
            '[SendAudio] send audio with url'
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFile($this->media->mp3()),
            '[SendAudio] send audio with file id 1/2 ' . $num
        )->send($this->telegramApi);
        
        $audioId = $sent->result()->audio()->fileId();

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFileId($audioId),
            '[SendAudio] send photo with file id 2/2 ' . $num
        )->send($this->telegramApi);

        self::assertTrue($sent->ok());
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromFile('non existent file'),
            '[SendAudio] parse error test'
        )->send($this->telegramApi);
    }

    function testCanParseError()
    {
        $sent = SendAudio::parameters(
            $this->config->groupId(),
            AudioFile::fromUrl('https://bob'),
            '[SendAudio] parse error test'
        )->send($this->telegramApi);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}