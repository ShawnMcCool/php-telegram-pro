<?php namespace TelegramPro\Types;

final class PhotoFile extends InputFile
{
    public static function fromFileId(string $fileId): PhotoFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): PhotoFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): PhotoFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        if (bytesToMegabytes(filesize($filePath)) > 10) {
            throw PhotoFileNotSupported::fileSizeIsGreaterThan10Megabyte($filePath);
        }

        return new static(null, null, $filePath);
    }
}