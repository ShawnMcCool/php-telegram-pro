<?php namespace TelegramPro\Types;

final class Animation
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $width;
    private int $height;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?string $fileSize;

    public function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
        int $width,
        int $height,
        int $duration,
        ?PhotoSize $thumb,
        ?string $fileName,
        ?string $mimeType,
        ?string $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($animation): ?Animation
    {
        if ( ! $animation) return null;

        return new static(
            FileId::fromString($animation->file_id),
            FileUniqueId::fromString($animation->file_unique_id),
            $animation->width,
            $animation->height,
            $animation->duration,
            PhotoSize::fromApi($animation->thumb ?? null),
            $animation->file_name ?? null,
            $animation->mime_type ?? null,
            $animation->file_size ?? null
        );
    }

    public function fileId(): FileId
    {
        return $this->fileId;
    }

    public function fileUniqueId(): FileUniqueId
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

    public function fileName(): ?string
    {
        return $this->fileName;
    }

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function fileSize(): ?string
    {
        return $this->fileSize;
    }
}