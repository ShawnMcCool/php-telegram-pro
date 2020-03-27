<?php namespace TelegramPro\Types;

use CURLFile;

final class InputMediaPhoto implements InputMedia
{
    private PhotoFile $photo;
    private ?Text $caption;

    private function __construct(
        PhotoFile $photo,
        ?Text $caption
    ) {
        $this->photo = $photo;
        $this->caption = $caption;
    }

    private function apiString(string $mediaKey = ''): string
    {
        return $this->photo->fileId()
        ?? $this->photo->url()
        ?? "attach://{$mediaKey}";
    }

    public static function fromFileId(
        FileId $fileId,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromFileId($fileId),
            $caption
        );
    }

    public static function fromUrl(
        Url $url,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromUrl($url),
            $caption
        );
    }

    public static function fromFile(
        FilePath $filePath,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromFilePath($filePath),
            $caption
        );
    }

    public function toApi(string $mediaKey): array
    {
        return array_filter(
            [
                'type' => 'photo',
                'media' => $this->apiString($mediaKey),
                'caption' => $this->caption
                    ? $this->caption->text()
                    : null,
                'parse_mode' => $this->caption
                    ? $this->caption->parseMode()->toParameter()
                    : null,
            ]
        );
    }
    
    public function toFile(): ?CURLFile
    {
        return $this->photo->filePath()
            ? new CURLFile($this->photo->filePath())
            : null;
    }
}