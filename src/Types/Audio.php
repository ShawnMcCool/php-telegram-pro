<?php namespace TelegramPro\Types;

final class Audio
{
    private string $fileId;
    private ?string $fileUniqueId;
    private int $duration;
    private ?string $performer;
    private ?string $title;
    private ?string $mimeType;
    private ?int $fileSize;
    private ?PhotoSize $thumb;

    public function __construct(
        string $fileId,
        ?string $fileUniqueId,
        int $duration,
        ?string $performer,
        ?string $title,
        ?string $mimeType,
        ?int $fileSize,
        ?PhotoSize $thumb
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
        $this->thumb = $thumb;
    }

    public static function fromApi($audio): ?Audio
    {
        if ( ! $audio) return null;
        
        return new static(
            $audio->file_id,
            $audio->file_unique_id ?? null,
            $audio->duration,
            $audio->performer ?? null,
            $audio->title ?? null,
            $audio->mime_type ?? null,
            $audio->file_size ?? null,
            PhotoSize::fromApi($audio->thumb ?? null)
        );
    }

    public function fileId(): string
    {
        return $this->fileId;
    }

    public function fileUniqueId(): ?string
    {
        return $this->fileUniqueId;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function performer(): ?string
    {
        return $this->performer;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }

    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }
}