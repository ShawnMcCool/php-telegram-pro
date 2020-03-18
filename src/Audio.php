<?php namespace TelegramPro;

final class Audio
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $duration;
    private ?string $performer;
    private ?string $title;
    private ?string $mimeType;
    private ?int $fileSize;
    private ?PhotoSize $thumb;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
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
            $audio->file_unique_id,
            $audio->duration,
            $audio->performer,
            $audio->title,
            $audio->mime_type,
            $audio->file_size,
            PhotoSize::fromRequest($audio->thumb)
        );
    ***REMOVED***
***REMOVED***