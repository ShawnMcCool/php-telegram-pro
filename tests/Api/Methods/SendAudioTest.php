<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Url;
use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\FilePath;
use TelegramPro\Methods\SendAudio;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;
use TelegramPro\Methods\FileUploads\AudioInputFile;

class SendAudioTest extends TelegramTestCase
{
    function testSendAudioFileWithFilePath()
    {
        $sent = SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromFilePath(
                FilePath::fromString($this->media->mp3())
            ),
            MediaCaption::fromString('[SendAudio] send audio with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithUrl()
    {
        $sent = SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromUrl(
                Url::fromString($this->media->audioUrl())
            ),
            MediaCaption::fromString('[SendAudio] send audio with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendAudioWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromFilePath(
                FilePath::fromString($this->media->mp3())
            ),
            MediaCaption::fromString('[SendAudio] send audio with file id 1/2 ' . $num)
        )->send($this->telegram);

        $audioId = $sent->result()->audio()->fileId();

        $sent = SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromFileId($audioId),
            MediaCaption::fromString('[SendAudio] send audio with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendAudio] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendAudio::parameters(
            $this->config->chatId(),
            AudioInputFile::fromUrl(Url::fromString('https://bob')),
            MediaCaption::fromString('[SendAudio] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}