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
        $response = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString($this->media->document())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with file path')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendDocumentWithUrl()
    {
        $response = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromUrl(
                Url::fromString($this->media->imageUrl())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with url')
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendDocumentWithFileId()
    {
        $num = rand(0, 32767);

        $response = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString($this->media->document())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with file id 1/2 ' . $num)
        )->send($this->telegram);

        $documentId = $response->sentMessage()->document()->fileId();

        $response = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromFileId($documentId),
            null,
            MediaCaption::fromString('[SendDocument] send photo with file id 2/2 ' . $num)
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testCanNotSendNonExistentFile()
    {
        $this->expectException(CanNotOpenFile::class);

        $response = SendDocument::parameters(
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
        $response = SendDocument::parameters(
            $this->config->chatId(),
            DocumentFile::fromUrl(
                Url::fromString('https://bob')
            ),
            null,
            MediaCaption::fromString('[SendDocument] parse error test')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}