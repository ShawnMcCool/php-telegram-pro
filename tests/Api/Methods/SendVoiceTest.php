<?php namespace Tests\Api\Methods;

use TelegramPro\Types\Url;
use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\FileId;
use TelegramPro\Types\Message;
use TelegramPro\Methods\SendVoice;
use TelegramPro\Types\MediaCaption;
use TelegramPro\Methods\MethodError;
use TelegramPro\Methods\FileUploads\FilePath;
use TelegramPro\Methods\FileUploads\VoiceFile;
use TelegramPro\Methods\FileUploads\CanNotOpenFile;

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
        self::assertInstanceOf(Message::class, $sent->result());
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
        self::assertInstanceOf(Message::class, $sent->result());
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
        
        $voiceId = $sent->result()->voice()->fileId();

        $sent = SendVoice::parameters(
            $this->config->chatId(),
            VoiceFile::fromFileId(
                FileId::fromApi($voiceId)
            ),
            MediaCaption::fromString('[SendVoice] send voice with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
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