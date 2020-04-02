<?php namespace TelegramPro\Methods\FileUploads;

use TelegramPro\Types\FileToUpload;

/**
 * A collection class for FileToUpload objects
 */
final class FilesToUpload
{
    private array $files;

    private function __construct(array $files)
    {
        $this->files = $files;
    }

    public static function list(?FileToUpload ...$files)
    {
        return new static(
            array_filter($files)
        );
    }

    /**
     * Array of FileToUpload objects
     */
    public function files(): array
    {
        return $this->files;
    }
}