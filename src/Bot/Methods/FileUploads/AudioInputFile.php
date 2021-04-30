<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use function TelegramPro\bytesToMegabytes;

/**
 * @inheritDoc
 */
final class AudioInputFile extends InputFile
{
    public static function fromFileId(FileId $fileId): static
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): AudioInputFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): AudioInputFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw AudioFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! static::isValidMimeType($filePath)) {
            throw AudioFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath->toString()));
        }

        return new static(null, null, $filePath);
    }

    private static function isValidMimeType(string $filePath)
    {
        return in_array(
            mime_content_type($filePath),
            [
                'audio/mpeg',
                'audio/mpeg3',
                'audio/x-mpeg-3',
                'audio/m4a',
                'audio/x-m4a',
            ]
        );
    }
}