<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use function TelegramPro\bytesToMegabytes;

/**
 * @inheritDoc
 */
final class VideoFile extends InputFile
{

    public static function fromFileId(FileId $fileId): VideoFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): VideoFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): VideoFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw VideoFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! static::isValidMimeType($filePath)) {
            throw VideoFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath));
        }

        return new static(null, null, $filePath);
    }

    private static function isValidMimeType(string $filePath)
    {
        return in_array(
            mime_content_type($filePath),
            [
                'video/mp4',
                'video/x-m4v',
            ]
        );
    }
}