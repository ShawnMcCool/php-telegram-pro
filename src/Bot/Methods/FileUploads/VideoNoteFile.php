<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use TelegramPro\Bot\Types\FileId;

/**
 * @inheritDoc
 */
final class VideoNoteFile extends InputFile
{
    public static function fromFileId(FileId $fileId): VideoNoteFile
    {
        return new static($fileId, null, null);
    }

    public static function fromFilePath(FilePath $filePath): VideoNoteFile
    {
        if ( ! static::isValidMimeType($filePath)) {
            throw VideoNoteFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath));
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