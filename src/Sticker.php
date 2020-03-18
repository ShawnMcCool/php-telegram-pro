<?php namespace TelegramPro;

final class Sticker
***REMOVED***
    private string $fileid;
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
        string $fileid,
        string $fileUniqueId,
        int $width,
        int $height,
        bool $isAnimated,
        ?PhotoSize $thumb,
        ?string $emoji,
        ?string $setName,
        ?MaskPosition $maskPosition,
        ?int $fileSize
    ) ***REMOVED***
        $this->fileid = $fileid;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->isAnimated = $isAnimated;
        $this->thumb = $thumb;
        $this->emoji = $emoji;
        $this->setName = $setName;
        $this->maskPosition = $maskPosition;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromRequest($sticker): ?Sticker
    ***REMOVED***
        if ( ! $sticker) return null;
        
        return new static(
            $sticker->file_id,
            $sticker->file_unique_id,
            $sticker->width,
            $sticker->height,
            $sticker->is_animated,
            PhotoSize::fromRequest($sticker->thumb),
            $sticker->emoji,
            $sticker->set_name,
            MaskPosition::fromRequest($sticker->mask_position),
            $sticker->file_size
        );
    ***REMOVED***
***REMOVED***