<?php namespace TelegramPro\Types;

final class VideoNote
{
    private string $fileId;
    private string $fileUniqueId;
    private int $length;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $length,
        int $duration,
        ?PhotoSize $thumb,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->length = $length;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($videoNote): ?VideoNote
    {
        if ( ! $videoNote) return null;

        return new static(
            $videoNote->file_id,
            $videoNote->file_unique_id,
            $videoNote->length,
            $videoNote->duration,
            PhotoSize::fromApi($videoNote->thumb),
            $videoNote->file_size,
        );
    }

    public function fileId(): string
    {
        return $this->fileId;
    }

    public function fileUniqueId(): string
    {
        return $this->fileUniqueId;
    }

    public function length(): int
    {
        return $this->length;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}