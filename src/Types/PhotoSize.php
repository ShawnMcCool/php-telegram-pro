<?php namespace TelegramPro\Types;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 */
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

    /**
     * Identifier for this file, which can be used to download or reuse the file
     */
    public function fileId(): FileId
    {
        return $this->fileId;
    }

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function fileUniqueId(): FileUniqueId
    {
        return $this->fileUniqueId;
    }

    /**
     * Photo width
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Photo height
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}