<?php namespace TelegramPro\Types;

final class VideoNoteFile extends InputFile
{
    public static function fromFileId(string $fileId): VideoNoteFile
    {
        return new static($fileId, null, null);
    }

    public static function fromFile(string $filePath): VideoNoteFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

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
                'video/x-m4v'
            ]
        );
    }
}