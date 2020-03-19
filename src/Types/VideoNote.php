<?php namespace TelegramPro\Types;

final class VideoNote
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $length;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $length,
        int $duration,
        ?PhotoSize $thumb,
        ?int $fileSize
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->length = $length;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromApi($videoNote): ?VideoNote
    ***REMOVED***
        if ( ! $videoNote) return null;

        return new static(
            $videoNote->file_id,
            $videoNote->file_unique_id,
            $videoNote->length,
            $videoNote->duration,
            PhotoSize::fromApi($videoNote->thumb),
            $videoNote->file_size,
        );
    ***REMOVED***
***REMOVED***