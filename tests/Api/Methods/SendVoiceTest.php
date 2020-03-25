<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Text;
use TelegramPro\Types\Message;
use TelegramPro\Types\VoiceFile;
use TelegramPro\Methods\SendVoice;
use TelegramPro\Methods\MethodError;
use TelegramPro\Types\CanNotOpenFile;

class SendVoiceTest extends TelegramTestCase
{
    function testSendVoiceFileWithFilePath()
    {
        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromFile($this->media->voice()),
            Text::plain('[SendVoice] send voice with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVoiceWithUrl()
    {
        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromUrl($this->media->voiceUrl()),
            Text::plain('[SendVoice] send voice with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVoiceWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromFile($this->media->voice()),
            Text::plain('[SendVoice] send voice with file id 1/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        
        $voiceId = $sent->result()->voice()->fileId();

        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromFileId($voiceId),
            Text::plain('[SendVoice] send voice with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromFile('non existent file'),
            Text::plain('[SendVoice] parse error test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendVoice::parameters(
            $this->config->groupId(),
            VoiceFile::fromUrl('https://bob'),
            Text::plain('[SendVoice] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}