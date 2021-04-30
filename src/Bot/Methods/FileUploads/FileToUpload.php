<?php namespace TelegramPro\Bot\Methods\FileUploads;

use CURLFile;

/**
 * Value object used by this SDK to track files and field names for generating api requests with nested objects containing files
 */
final class FileToUpload
{
    private FilePath $filePath;

    private function __construct(
        private string $formFieldName,
        FilePath $file
    ) {
        $this->filePath = $file;
    }

    public function formFieldName(): string
    {
        return $this->formFieldName;
    }

    public function filePath(): FilePath
    {
        return $this->filePath;
    }

    public function curlFile(): CURLFile
    {
        return new CURLFile($this->filePath->toString());
    }

    public static function fromFilePath(
        string $formFieldName,
        FilePath $filePath
    ): static {
        return new static(
            $formFieldName,
            $filePath
        );
    }
}