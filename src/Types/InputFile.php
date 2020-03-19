<?php namespace TelegramPro\Types;

final class InputFile
{
    private ?string $fileId;
    private ?string $url;
    private ?string $binaryData;

    public function __construct(
        ?string $fileId,
        ?string $url,
        $binaryData
    ) {
        $this->fileId = $fileId;
        $this->url = $url;
        $this->binaryData = $binaryData;
    }

    public function toApi()
    {
        return $this->fileId ?? $this->url ?? $this->binaryData;
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

        return static::fromBinary(
            file_get_contents($filePath)
        );
    }

    public static function fromBinary($binaryData): InputFile
    {
        return new static(null, null, $binaryData);
    }
}