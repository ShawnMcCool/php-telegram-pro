<?php namespace Tests\Unit\Types;

use TelegramPro\Types\Url;
use Tests\TelegramTestCase;
use TelegramPro\Types\FileId;
use TelegramPro\Types\FilePath;
use TelegramPro\Types\CanNotValidateUrl;
use TelegramPro\Methods\FileUploads\InputFile;

class InputFileTest extends TelegramTestCase
{
    function testMakeInputFileFromFileId()
    {
        $file = InputFile::fromFileId(
            FileId::fromString('file id')
        );

        $this->sameValue('file id', $file->fileId());
    }

    function testMakeInputFileFromUrl()
    {
        $file = InputFile::fromUrl(
            Url::fromString('https://github.com')
        );
        $this->sameValue('https://github.com', $file->url());

        $this->expectException(CanNotValidateUrl::class);
        InputFile::fromUrl(
            Url::fromString('url')
        );
    }

    function testMakeInputFileFromFile()
    {
        $imagePath = $this->media->image();

        $file = InputFile::fromFilePath(
            FilePath::fromString($imagePath)
        );

        $this->sameValue(
            $imagePath,
            $file->filePath()
        );
    }
}
