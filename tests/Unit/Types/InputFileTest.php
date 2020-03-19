<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Types\InputFile;
use TelegramPro\Types\CanNotValidateUrl;

class InputFileTest extends TelegramTestCase
{
    function testMakeInputFileFromFileId()
    {
        $file = InputFile::fromFileId('file id');
        self::assertSame('file id', $file->toApi());
    }

    function testMakeInputFileFromUrl()
    {
        $file = InputFile::fromUrl('https://github.com');
        self::assertSame('https://github.com', $file->toApi());

        $this->expectException(CanNotValidateUrl::class);
        InputFile::fromUrl('url');
    }

    function testMakeInputFileFromFile()
    {
        $imagePath = $this->media->imagePath();

        $file = InputFile::fromFile($imagePath);

        self::assertSame(
            filesize($imagePath),
            strlen($file->toApi())
        );
    }

    function testMakeInputFileFromBinary()
    {
        $imagePath = $this->media->imagePath();

        $file = InputFile::fromBinary(
            file_get_contents($imagePath)
        );

        self::assertSame(
            filesize($imagePath),
            strlen($file->toApi())
        );
    }
}
