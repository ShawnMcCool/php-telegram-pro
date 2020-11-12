<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Types\MaskPosition;
use TelegramPro\Bot\Types\FileUniqueId;

/**
 * This object represents a sticker.
 */
final class Sticker implements ApiReadType
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $width;
    private int $height;
    private bool $isAnimated;
    private ?PhotoSize $thumb;
    private ?string $emoji;
    private ?string $setName;
    private ?MaskPosition $maskPosition;
    private ?int $fileSize;

    private function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
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
     * Sticker width
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Sticker height
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * True, if the sticker is animated
     */
    public function isAnimated(): bool
    {
        return $this->isAnimated;
    }

    /**
     * Optional. Sticker thumbnail in the .WEBP or .JPG format
     */
    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    /**
     * Optional. Emoji associated with the sticker
     */
    public function emoji(): ?string
    {
        return $this->emoji;
    }

    /**
     * Optional. Name of the sticker set to which the sticker belongs
     */
    public function setName(): ?string
    {
        return $this->setName;
    }

    /**
     * Optional. For mask stickers, the position where the mask should be placed
     */
    public function maskPosition(): ?MaskPosition
    {
        return $this->maskPosition;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}