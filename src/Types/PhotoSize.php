<?php namespace TelegramPro\Types;

final class PhotoSize
{
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
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

    public static function arrayfromApi(?array $photoSizes): ?array
    {
        if ( ! $photoSizes) return null;
        
        $photoSizeArray = [];
        
        foreach ($photoSizes as $photoSize) {
            $photoSizeArray[] = PhotoSize::fromApi($photoSize);
        }
        
        return $photoSizeArray;
    }

    public static function fromApi($thumb): ?PhotoSize
    {
        if ( ! $thumb) return null;

        return new static(
            $thumb->file_id,
            $thumb->file_unique_id,
            $thumb->width,
            $thumb->height,
            $thumb->file_size
        );
    }
}