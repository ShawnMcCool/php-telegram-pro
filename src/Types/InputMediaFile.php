<?php namespace TelegramPro\Types;

final class InputMediaFile extends InputFile
{
    public static function fromFileId(string $fileId): InputMediaFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): InputMediaFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): InputMediaFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        return new static(null, null, $filePath);
    }
}