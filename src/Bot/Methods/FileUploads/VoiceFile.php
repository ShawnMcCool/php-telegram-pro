<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use function TelegramPro\bytesToMegabytes;

final class VoiceFile extends InputFile
{
    public static function fromFileId(FileId $fileId): VoiceFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): VoiceFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): VoiceFile
    {
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