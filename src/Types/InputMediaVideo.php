<?php namespace TelegramPro\Types;

use CURLFile;

final class InputMediaVideo implements InputMedia
{
    private VideoFile $video;
    private ?Text $caption;
    private ?PhotoFile $thumb;
    private ?int $width;
    private ?int $height;
    private ?int $duration;
    private ?bool $supportsStreaming;

    private function __construct(
        VideoFile $video,
        ?Text $caption,
        ?PhotoFile $thumb,
        ?int $width,
        ?int $height,
        ?int $duration,
        ?bool $supportsStreaming
    ) {
        $this->video = $video;
        $this->caption = $caption;
        $this->thumb = $thumb;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->supportsStreaming = $supportsStreaming;
    }

    public function toApi(string $mediaKey): array
    {
        return array_filter(
            [
                'type' => 'video',
                'media' => $this->video->fileId()
                    ?? $this->video->url()
                    ?? "attach://{$mediaKey}",
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
        return $this->video->filePath()
            ? new CURLFile(realpath($this->video->filePath()))
            : null;
    }

    public static function fromFileId(
        string $fileId,
        ?Text $caption = null,
        ?PhotoFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): InputMediaVideo {
        return new static(
            VideoFile::fromFileId($fileId),
            $caption,
            $thumb,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }

    public static function fromUrl(
        string $url,
        ?Text $caption = null,
        ?PhotoFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): InputMediaVideo {
        return new static(
            VideoFile::fromUrl($url),
            $caption,
            $thumb,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }

    public static function fromFile(
        string $filePath,
        ?Text $caption = null,
        ?PhotoFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): InputMediaVideo {
        return new static(
            VideoFile::fromFile($filePath),
            $caption,
            $thumb,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }
}