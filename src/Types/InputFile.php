<?php namespace TelegramPro\Types;

use CURLFile;

class InputFile
{
    private ?string $fileId;
    private ?string $url;
    private ?string $filePath;

    public function __construct(
        ?string $fileId,
        ?string $url,
        ?string $filePath
    ) {
        $this->fileId = $fileId;
        $this->url = $url;
        $this->filePath = $filePath;
    }

    public function fileId(): ?string
    {
        return $this->fileId;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function filePath(): ?string
    {
        return $this->filePath;
    }

    public function toApi()
    {
        return $this->fileId ?? $this->url ?? new CURLFile(realpath($this->filePath));
    }

    public static function fromFileId(string $fileId): InputFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(string $url): InputFile
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static(null, $url, null);
    }

    public static function fromFile(string $filePath): InputFile
    {
        if ( ! file_exists($filePath)) {
            throw CanNotOpenFile::fileDoesNotExist($filePath);
        }

        return new static(null, null, $filePath);
    }
}