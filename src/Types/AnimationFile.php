<?php namespace TelegramPro\Types;

final class AnimationFile extends InputFile
{
    public static function fromFileId(FileId $fileId): AnimationFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): AnimationFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): AnimationFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw AnimationFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! static::isValidMimeType($filePath)) {
            throw AnimationFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath));
        }

        return new static(null, null, $filePath);
    }

    private static function isValidMimeType(string $filePath)
    {
        return in_array(
            mime_content_type($filePath),
            [
                'image/gif',
                'video/mp4',
                'video/H264',
            ]
        );
    }
}