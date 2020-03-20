<?php namespace TelegramPro\Types;

final class DocumentFile extends InputFile
{
    public static function fromFileId(string $fileId): DocumentFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): DocumentFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): DocumentFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw DocumentFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        return new static(null, null, $filePath);
    }
}