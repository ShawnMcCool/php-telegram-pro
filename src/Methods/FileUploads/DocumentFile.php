<?php namespace TelegramPro\Methods\FileUploads;

use TelegramPro\Types\FileId;
use TelegramPro\Methods\Types\Url;

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