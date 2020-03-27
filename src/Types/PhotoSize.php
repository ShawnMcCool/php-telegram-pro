<?php namespace TelegramPro\Types;

final class PhotoSize
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $width;
    private int $height;
    private ?int $fileSize;

    public function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
        int $width,
        int $height,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($thumb): ?PhotoSize
    {
        if ( ! $thumb) return null;
        
        return new static(
            FileId::fromString($thumb->file_id),
            FileUniqueId::fromString($thumb->file_unique_id),
            $thumb->width,
            $thumb->height,
            $thumb->file_size
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

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}