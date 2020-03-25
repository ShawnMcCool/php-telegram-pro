<?php namespace TelegramPro\Types;

final class Sticker
{
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private bool $isAnimated;
    private ?PhotoSize $thumb;
    private ?string $emoji;
    private ?string $setName;
    private ?MaskPosition $maskPosition;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $width,
        int $height,
        bool $isAnimated,
        ?PhotoSize $thumb,
        ?string $emoji,
        ?string $setName,
        ?MaskPosition $maskPosition,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->isAnimated = $isAnimated;
        $this->thumb = $thumb;
        $this->emoji = $emoji;
        $this->setName = $setName;
        $this->maskPosition = $maskPosition;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($sticker): ?Sticker
    {
        if ( ! $sticker) return null;
        
        return new static(
            $sticker->file_id,
            $sticker->file_unique_id,
            $sticker->width,
            $sticker->height,
            $sticker->is_animated,
            PhotoSize::fromApi($sticker->thumb),
            $sticker->emoji,
            $sticker->set_name,
            MaskPosition::fromApi($sticker->mask_position),
            $sticker->file_size
        );
    }
}