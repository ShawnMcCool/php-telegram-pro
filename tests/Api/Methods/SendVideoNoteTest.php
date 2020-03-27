<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\FilePath;
use TelegramPro\Types\VideoNoteFile;
use TelegramPro\Types\CanNotOpenFile;
use TelegramPro\Methods\SendVideoNote;

class SendVideoNoteNoteTest extends TelegramTestCase
{
    function testSendVideoNoteWithFilePath()
    {
        $sent = SendVideoNote::parameters(
            $this->config->chatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString($this->media->videoNote())
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendVideoNoteWithFileId()
    {
        $sent = SendVideoNote::parameters(
            $this->config->chatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString($this->media->videoNote())
            )
        )->send($this->telegram);
        
        $sent = SendVideoNote::parameters(
            $this->config->chatId(),
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

        SendVideoNote::parameters(
            $this->config->chatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString('non existent file')
            )
        )->send($this->telegram);
    }
}