<?php namespace TelegramPro\Types;

final class Voice
{
    private FileId $fileId;
    private ?FileUniqueId $fileUniqueId;
    private int $duration;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        FileId $fileId,
        ?FileUniqueId $fileUniqueId,
        int $duration,
        ?string $mimeType,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($voice): ?Voice
    {
        if ( ! $voice) return null;

        return new static(
            FileId::fromString($voice->file_id),
            FileUniqueId::fromString($voice->file_unique_id ?? null),
            $voice->duration,
            $voice->mime_type ?? null,
            $voice->file_size ?? null
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

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}