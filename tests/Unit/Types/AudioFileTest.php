<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Types\FilePath;
use TelegramPro\Methods\FileUploads\AudioInputFile;
use TelegramPro\Methods\FileUploads\AudioFileNotSupported;

class AudioFileTest extends TelegramTestCase
{
    function testCanRepresentMp3Files()
    {
        $audio = AudioInputFile::fromFilePath(
            FilePath::fromString($this->media->mp3())
        );
        
        $this->sameValue(
            FilePath::fromString($this->media->mp3()),
            $audio->filePath()
        );
    }

    function testCanRepresentM4aFiles()
    {
        $audio = AudioInputFile::fromFilePath(
            FilePath::fromString(
                $this->media->m4a()
            )
        );

        $this->sameValue(
            FilePath::fromString($this->media->m4a()),
            $audio->filePath()
        );
    }

    function testRejectsUnsupportedTypes()
    {
        $this->expectException(AudioFileNotSupported::class);
        
        AudioInputFile::fromFilePath(
            FilePath::fromString(
                $this->media->image()
            )
        );
    }
}
