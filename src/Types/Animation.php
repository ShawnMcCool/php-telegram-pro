<?php namespace TelegramPro\Types;

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

    public static function fromApi($animation): ?Animation
    ***REMOVED***
        if ( ! $animation) return null;

        return new static(
            $animation->file_id,
            $animation->file_unique_id,
            $animation->width,
            $animation->height,
            $animation->duration,
            PhotoSize::fromApi($animation->thumb ?? null),
            $animation->file_name ?? null,
            $animation->mime_type ?? null,
            $animation->file_size ?? null
        );
    ***REMOVED***

    public function fileId(): string
    ***REMOVED***
        return $this->fileId;
    ***REMOVED***

    public function fileUniqueId(): string
    ***REMOVED***
        return $this->fileUniqueId;
    ***REMOVED***

    public function width(): int
    ***REMOVED***
        return $this->width;
    ***REMOVED***

    public function height(): int
    ***REMOVED***
        return $this->height;
    ***REMOVED***

    public function duration(): int
    ***REMOVED***
        return $this->duration;
    ***REMOVED***

    public function thumb(): ?PhotoSize
    ***REMOVED***
        return $this->thumb;
    ***REMOVED***

    public function fileName(): ?string
    ***REMOVED***
        return $this->fileName;
    ***REMOVED***

    public function mimeType(): ?string
    ***REMOVED***
        return $this->mimeType;
    ***REMOVED***

    public function fileSize(): ?string
    ***REMOVED***
        return $this->fileSize;
    ***REMOVED***
***REMOVED***