<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;

/**
 * @inheritDoc
 */
final class InputPhotoFile extends InputFile
{
    /**
     * If the file is already stored somewhere on the Telegram servers, you don't need to re-upload it: each file object has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files sent this way.
     */
    public static function fromFileId(FileId $fileId): InputPhotoFile
    {
        return new static($fileId, null, null);
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     */
    public static function fromUrl(Url $url): InputPhotoFile
    {
        return new static(null, $url, null);
    }

    /**
     * Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
     */
    public static function fromFilePath(FilePath $filePath): InputPhotoFile
    {
        if (bytesToMegabytes(filesize($filePath)) > 10) {
            throw PhotoFileNotSupported::fileSizeIsGreaterThan10Megabyte($filePath);
        }

        return new static(null, null, $filePath);
    }
}