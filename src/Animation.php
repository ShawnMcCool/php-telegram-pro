<?php namespace TelegramPro;

final class Animation
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?string $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $width,
        int $height,
        int $duration,
        ?PhotoSize $thumb,
        ?string $fileName,
        ?string $mimeType,
        ?string $fileSize
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromRequest($animation): ?Animation
    ***REMOVED***
        if ( ! $animation) return null;

        return new static(
            $animation->file_id,
            $animation->file_unique_id,
            $animation->width,
            $animation->height,
            $animation->duration,
            PhotoSize::fromRequest($animation->thumb),
            $animation->file_name,
            $animation->mime_type,
            $animation->file_size
        );
    ***REMOVED***
***REMOVED***