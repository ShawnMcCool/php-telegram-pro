<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\SendDocument;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\DocumentFile;
use TelegramPro\Bot\Methods\FileUploads\CanNotOpenFile;

class SendDocumentTest extends TelegramTestCase
{
    function testSendDocumentFileWithFilePath()
    {
        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString($this->media->document())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with file path')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendDocumentWithUrl()
    {
        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromUrl(
                Url::fromString($this->media->imageUrl())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with url')
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testSendDocumentWithFileId()
    {
        $num = rand(0, 32767);

        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString($this->media->document())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with file id 1/2 ' . $num)
        )->send($this->telegram);

        $documentId = $sent->botInformation()->document()->fileId();

        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFileId($documentId),
            null,
            MediaCaption::fromString('[SendDocument] send photo with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($sent);
        self::assertInstanceOf(Message::class, $sent->botInformation());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString('non existent file')
            ),
            null,
            MediaCaption::fromString('[SendDocument] non existent file exception test')
        )->send($this->telegram);
    }

    function testCanParseError()
    {
        $sent = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromUrl(
                Url::fromString('https://bob')
            ),
            null,
            MediaCaption::fromString('[SendDocument] parse error test')
        )->send($this->telegram);

        self::assertFalse($sent->ok());
        self::assertInstanceOf(MethodError::class, $sent->error());
        self::assertSame('400', $sent->error()->code());
        self::assertNotEmpty($sent->error()->description());
    }
}