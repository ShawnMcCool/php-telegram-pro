<?php namespace TelegramPro\Types;

final class AudioFile extends InputFile
{
    public static function fromFileId(string $fileId): AudioFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): AudioFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): AudioFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }
        
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw AudioFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! static::isValidMimeType($filePath)) {
            throw AudioFileNotSupported::formatNotSupported($filePath);
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