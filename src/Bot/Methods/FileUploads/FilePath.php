<?php namespace TelegramPro\Bot\Methods\FileUploads;

/**
 * Path to a file available locally
 */
final class FilePath
{
    private function __construct(
        private string $filePath
    ) {
    }

    public static function fromString(string $filePath): FilePath
    {
        $filePath = realpath($filePath);

        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        return new static($filePath);
    }

    public function toString(): string
    {
        return $this->filePath;
    }

    public function __toString(): string
    {
        return $this->filePath;
    }
}