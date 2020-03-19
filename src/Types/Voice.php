<?php namespace TelegramPro\Types;

final class Voice
***REMOVED***
    private string $fileId;
    private ?string $fileUniqueId;
    private int $duration;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        ?string $fileUniqueId,
        int $duration,
        ?string $mimeType,
        ?int $fileSize
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromApi($voice): ?Voice
    ***REMOVED***
        if ( ! $voice) return null;

        return new static(
            $voice->file_id,
            $voice->file_unique_id ?? null,
            $voice->duration,
            $voice->mime_type ?? null,
            $voice->file_size ?? null
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

    public function mimeType(): ?string
    ***REMOVED***
        return $this->mimeType;
    ***REMOVED***

    public function fileSize(): ?int
    ***REMOVED***
        return $this->fileSize;
    ***REMOVED***
***REMOVED***