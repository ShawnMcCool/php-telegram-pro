<?php namespace TelegramPro\Types;

final class Video
{
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $width,
        int $height,
        int $duration,
        ?PhotoSize $thumb,
        ?string $mimeType,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public function fileId(): string
    {
        return $this->fileId;
    }

    public function fileUniqueId(): string
    {
        return $this->fileUniqueId;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }

    public static function fromApi($video): ?Video
    {
        if ( ! $video) return null;

        return new static(
            $video->file_id,
            $video->file_unique_id,
            $video->width,
            $video->height,
            $video->duration,
            PhotoSize::fromApi($video->thumb ?? null),
            $video->mime_type,
            $video->file_size,
        );
    }
}