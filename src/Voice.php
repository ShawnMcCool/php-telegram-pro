<?php namespace TelegramPro;

final class Voice
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $duration;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
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

    public static function fromRequest($voice): ?Voice
    ***REMOVED***
        if ( ! $voice) return null;

        return new static(
            $voice->file_id,
            $voice->file_unique_id,
            $voice->duration,
            $voice->mime_type,
            $voice->file_size
        );
    ***REMOVED***
***REMOVED***