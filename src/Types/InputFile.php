<?php namespace TelegramPro\Types;

use CURLFile;

class InputFile
{
    private ?FileId $fileId;
    private ?Url $url;
    private ?FilePath $filePath;

    public function __construct(
        ?FileId $fileId,
        ?Url $url,
        ?FilePath $filePath
    ) {
        $this->fileId = $fileId;
        $this->url = $url;
        $this->filePath = $filePath;
    }

    public function fileId(): ?FileId
    {
        return $this->fileId;
    }

    public function url(): ?Url
    {
        return $this->url;
    }

    public function filePath(): ?FilePath
    {
        return $this->filePath;
    }

    public function toApi()
    {
        return $this->fileId ?? $this->url ?? new CURLFile($this->filePath);
    }

    public static function fromFileId(FileId $fileId): InputFile
    {
        return new static($fileId, null, null);
    }

    public static function fromUrl(Url $url): InputFile
    {
        return new static(null, $url, null);
    }

    public static function fromFilePath(FilePath $filePath): InputFile
    {
        return new static(null, null, $filePath);
    }
}