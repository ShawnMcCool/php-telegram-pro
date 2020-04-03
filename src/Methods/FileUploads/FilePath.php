<?php namespace TelegramPro\Methods\FileUploads;

/**
 * Path to a file available locally
 */
final class FilePath
{
    private string $filePath;

    private function __construct(string $filePath)
    {
        $this->filePath = $filePath;
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