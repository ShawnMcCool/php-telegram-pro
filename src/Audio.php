<?php namespace TelegramPro;

final class Audio
***REMOVED***
    private string $fileId;
    private ?string $fileUniqueId;
    private int $duration;
    private ?string $performer;
    private ?string $title;
    private ?string $mimeType;
    private ?int $fileSize;
    private ?PhotoSize $thumb;

    public function __construct(
        string $fileId,
        ?string $fileUniqueId,
        int $duration,
        ?string $performer,
        ?string $title,
        ?string $mimeType,
        ?int $fileSize,
        ?PhotoSize $thumb
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
        $this->thumb = $thumb;
    ***REMOVED***

    public static function fromRequest($audio): ?Audio
    ***REMOVED***
        if ( ! $audio) return null;
        
        return new static(
            $audio->file_id,
            $audio->file_unique_id ?? null,
            $audio->duration,
            $audio->performer ?? null,
            $audio->title ?? null,
            $audio->mime_type ?? null,
            $audio->file_size ?? null,
            PhotoSize::fromRequest($audio->thumb ?? null)
        );
    ***REMOVED***

    public function fileId(): string
    ***REMOVED***
        return $this->fileId;
    ***REMOVED***

    public function fileUniqueId(): ?string
    ***REMOVED***
        return $this->fileUniqueId;
    ***REMOVED***

    public function duration(): int
    ***REMOVED***
        return $this->duration;
    ***REMOVED***

    public function performer(): ?string
    ***REMOVED***
        return $this->performer;
    ***REMOVED***

    public function title(): ?string
    ***REMOVED***
        return $this->title;
    ***REMOVED***

    public function mimeType(): ?string
    ***REMOVED***
        return $this->mimeType;
    ***REMOVED***

    public function fileSize(): ?int
    ***REMOVED***
        return $this->fileSize;
    ***REMOVED***

    public function thumb(): ?PhotoSize
    ***REMOVED***
        return $this->thumb;
    ***REMOVED***
***REMOVED***