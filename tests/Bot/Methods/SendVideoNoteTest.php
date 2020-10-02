<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\SendVideoNote;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\VideoNoteFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;

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
        self::assertInstanceOf(Message::class, $sent->botInformation());
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
                $sent->botInformation()->videoNote()->fileId()
            )
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
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