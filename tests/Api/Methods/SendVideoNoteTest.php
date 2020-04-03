<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Methods\SendVideoNote;
use TelegramPro\Methods\FileUploads\FilePath;
use TelegramPro\Methods\FileUploads\VideoNoteFile;
use TelegramPro\Methods\FileUploads\CanNotOpenFile;

class SendVideoNoteTest extends TelegramTestCase
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