<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\Message;
use TelegramPro\Types\DocumentFile;
use TelegramPro\Methods\MethodError;
use TelegramPro\Methods\SendDocument;
use TelegramPro\Types\CanNotOpenFile;

class SendDocumentTest extends TelegramTestCase
{
    function testSendDocumentFileWithFilePath()
    {
        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromFile($this->media->document()),
            null,
            '[SendDocument] send document with file path'
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendDocumentWithUrl()
    {
        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromUrl($this->media->imageUrl()),
            null,
            '[SendDocument] send document with url'
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testSendDocumentWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromFile($this->media->document()),
            null,
            '[SendDocument] send document with file id 1/2 ' . $num
        )->send($this->telegram);

        $documentId = $sent->result()->document()->fileId();

        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromFileId($documentId),
            null,
            '[SendDocument] send photo with file id 2/2 ' . $num
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->result());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromFile('non existent file'),
            null,
            '[SendDocument] non existent file exception test'
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendDocument::parameters(
            $this->config->groupId(),
            DocumentFile::fromUrl('https://bob'),
            null,
            '[SendDocument] parse error test'
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}