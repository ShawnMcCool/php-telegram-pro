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

    public static function fromFileId(
        string $fileId,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromFileId($fileId),
            $caption
        );
    }

    public static function fromUrl(
        string $url,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromUrl($url),
            $caption
        );
    }

    public static function fromFile(
        string $filePath,
        ?Text $caption = null
    ): InputMediaPhoto {
        return new static(
            PhotoFile::fromFile($filePath),
            $caption
        );
    }

    public function toApi(string $mediaKey): array
    {
        return array_filter(
            [
                'type' => 'photo',
                'media' => $this->photo->fileId()
                    ?? $this->photo->url()
                    ?? "attach://{$mediaKey}",
                'caption' => $this->caption
                    ? $this->caption->toString()
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
            ? new CURLFile(realpath($this->photo->filePath()))
            : null;
    }
}