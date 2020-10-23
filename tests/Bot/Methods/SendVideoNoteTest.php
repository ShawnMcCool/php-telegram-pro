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
        $response = SendVideoNote::parameters(
            $this->config->supergroupChatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString($this->media->videoNote())
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendVideoNoteWithFileId()
    {
        $response = SendVideoNote::parameters(
            $this->config->supergroupChatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString($this->media->videoNote())
            )
        )->send($this->telegram);
        
        $response = SendVideoNote::parameters(
            $this->config->supergroupChatId(),
            VideoNoteFile::fromFileId(
                $response->sentMessage()->videoNote()->fileId()
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        SendVideoNote::parameters(
            $this->config->supergroupChatId(),
            VideoNoteFile::fromFilePath(
                FilePath::fromString('non existent file')
            )
        )->send($this->telegram);
    }
}