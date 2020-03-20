<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\VideoNoteFile;
use TelegramPro\Types\CanNotOpenFile;
use TelegramPro\Methods\SendVideoNote;

class SendVideoNoteNoteTest extends TelegramTestCase
{
    function testSendVideoNoteWithFilePath()
    {
        $sent = SendVideoNote::parameters(
            $this->config->groupId(),
            VideoNoteFile::fromFile($this->media->videoNote())
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVideoNoteWithFileId()
    {
        $sent = SendVideoNote::parameters(
            $this->config->groupId(),
            VideoNoteFile::fromFile($this->media->videoNote())
        )->send($this->telegram);
        
        $sent = SendVideoNote::parameters(
            $this->config->groupId(),
            VideoNoteFile::fromFileId(
                $sent->result()->videoNote()->fileId()
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendVideoNote::parameters(
            $this->config->groupId(),
            VideoNoteFile::fromFile('non existent file')
        )->send($this->telegram);
    }
}