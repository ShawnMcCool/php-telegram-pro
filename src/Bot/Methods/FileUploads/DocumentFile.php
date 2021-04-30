<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use function TelegramPro\bytesToMegabytes;

/**
 * @inheritDoc
 */
final class DocumentFile extends InputFile
{
    public static function fromFileId(FileId $fileId): DocumentFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): DocumentFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): DocumentFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw DocumentFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        return new static(null, null, $filePath);
    }
}