<?php namespace Tests\Unit\Types;

use Tests\TelegramTestCase;
use TelegramPro\Types\AudioFile;
use TelegramPro\Types\AudioFileTypeNotSupported;

class AudioFileTest extends TelegramTestCase
{
    function testCanRepresentMp3Files()
    {
        $audio = AudioFile::fromFile(
            $this->media->mp3()
        );

        self::assertSame(
            $this->media->mp3(),
            $audio->filePath()
        );
    }

    function testCanRepresentM4aFiles()
    {
        $audio = AudioFile::fromFile(
            $this->media->m4a()
        );

        self::assertSame(
            $this->media->m4a(),
            $audio->filePath()
        );
    }

    function testRejectsUnsupportedTypes()
    {
        $this->expectException(AudioFileTypeNotSupported::class);
        
        AudioFile::fromFile(
            $this->media->image()
        );
    }
}
