<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendVoice;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\VoiceFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;

class SendVoiceTest extends TelegramTestCase
{
    function testSendVoiceFileWithFilePath()
    {
        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromFilePath(
                FilePath::fromString($this->media->voice())
            ),
            MediaCaption::fromString('[SendVoice] send voice with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendVoiceWithUrl()
    {
        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromUrl(
                Url::fromString($this->media->voiceUrl())
            ),
            MediaCaption::fromString('[SendVoice] send voice with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendVoiceWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromFilePath(
                FilePath::fromString($this->media->voice())
            ),
            MediaCaption::fromString('[SendVoice] send voice with file id 1/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        
        $voiceId = $response->sentMessage()->voice()->fileId();
        
        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromFileId(
                $voiceId
            ),
            MediaCaption::fromString('[SendVoice] send voice with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendVoice] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $response = SendVoice::parameters(
            $this->config->validGroup(),
            VoiceFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendVoice] parse error test')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}