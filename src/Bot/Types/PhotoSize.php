<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 */
final class PhotoSize implements ApiReadType
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $width;
    private int $height;
    private ?int $fileSize;

    private function __construct(
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($thumb): ?PhotoSize
    {
        if ( ! $thumb) return null;
        
        return new static(
            FileId::fromApi($thumb->file_id),
            FileUniqueId::fromApi($thumb->file_unique_id),
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