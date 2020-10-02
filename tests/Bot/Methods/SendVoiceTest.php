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
        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromFilePath(
                FilePath::fromString($this->media->voice())
            ),
            MediaCaption::fromString('[SendVoice] send voice with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendVoiceWithUrl()
    {
        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromUrl(
                Url::fromString($this->media->voiceUrl())
            ),
            MediaCaption::fromString('[SendVoice] send voice with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendVoiceWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromFilePath(
                FilePath::fromString($this->media->voice())
            ),
            MediaCaption::fromString('[SendVoice] send voice with file id 1/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        
        $voiceId = $sent->botInformation()->voice()->fileId();
        
        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromFileId(
                $voiceId
            ),
            MediaCaption::fromString('[SendVoice] send voice with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            MediaCaption::fromString('[SendVoice] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromUrl(
                Url::fromString('https://bob')
            ),
            MediaCaption::fromString('[SendVoice] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}