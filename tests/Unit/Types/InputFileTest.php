<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Types\InputFile;
use TelegramPro\Types\CanNotValidateUrl;

class InputFileTest extends TelegramTestCase
{
    function testMakeInputFileFromFileId()
    {
        $file = InputFile::fromFileId('file id');
        self::assertSame('file id', $file->fileId());
    }

    function testMakeInputFileFromUrl()
    {
        $file = InputFile::fromUrl('https://github.com');
        self::assertSame('https://github.com', $file->url());

        $this->expectException(CanNotValidateUrl::class);
        InputFile::fromUrl('url');
    }

    function testMakeInputFileFromFile()
    {
        $imagePath = $this->media->image();

        $file = InputFile::fromFile($imagePath);

        self::assertSame(
            $imagePath,
            $file->filePath()
        );
    }
}
