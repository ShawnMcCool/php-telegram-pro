<?php namespace TelegramPro\Types;

final class PhotoFile extends InputFile
{
    public static function fromFileId(FileId $fileId): PhotoFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): PhotoFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): PhotoFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 10) {
            throw PhotoFileNotSupported::fileSizeIsGreaterThan10Megabyte($filePath);
        }

        return new static(null, null, $filePath);
    }
}