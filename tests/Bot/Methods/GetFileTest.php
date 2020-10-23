<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\GetFile;
use TelegramPro\Bot\Methods\Types\File;
use TelegramPro\Bot\Methods\SendDocument;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\DocumentFile;

class GetFileTest extends TelegramTestCase
{
    function testCanGetDocumentFileInformation()
    {
        $sendDocumentResponse = SendDocument::parameters(
            $this->config->cyclingChatId(),
            DocumentFile::fromFilePath(
                FilePath::fromString($this->media->document())
            ),
            null,
            MediaCaption::fromString('[SendDocument] send document with file path')
        )->send($this->telegram);


        $response = GetFile::parameters(
            $sendDocumentResponse->sentMessage()->document()->fileId()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(File::class, $response->file());

        self::assertTrue(\string\starts_with($response->file()->filePath(), 'documents/file'));
        self::assertSame(151827, $response->file()->fileSize());
    }

    function testCanParseError()
    {
        $response = GetFile::parameters(
            FileId::fromString('wrong file id')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
