<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendAudio;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\AudioInputFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;


class SendAudioTest extends TelegramTestCase
{
    function testSendAudioFileWithFilePath()
    {
        $response = SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromFilePath(
                FilePath::fromString($this->media->mp3())
            ),
            MediaCaption::fromString('[SendAudio] send audio with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendAudioWithUrl()
    {
        $response = SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromUrl(
                Url::fromString($this->media->audioUrl())
            ),
            MediaCaption::fromString('[SendAudio] send audio with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendAudioWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromFilePath(
                FilePath::fromString($this->media->mp3())
            ),
            MediaCaption::fromString('[SendAudio] send audio with file id 1/2 ' . $num)
        )->send($this->telegram);

        $audioId = $response->sentMessage()->audio()->fileId();

        $response = SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromFileId($audioId),
            MediaCaption::fromString('[SendAudio] send audio with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendAudio] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendAudio::parameters(
            $this->config->validGroup(),
            AudioInputFile::fromUrl(Url::fromString('https://bob')),
            MediaCaption::fromString('[SendAudio] parse error test')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}