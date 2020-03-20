<?php namespace TelegramPro\Types;

final class VoiceFile extends InputFile
{
    public static function fromFileId(string $fileId): VoiceFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): VoiceFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): VoiceFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw VoiceFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! static::isValidMimeType($filePath)) {
            throw VoiceFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath));
        }

        return new static(null, null, $filePath);
    }

    private static function isValidMimeType(string $filePath)
    {
        return in_array(
            mime_content_type($filePath),
            [
                'audio/ogg',
            ]
        );
    }
}