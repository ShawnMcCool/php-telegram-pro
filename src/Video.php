<?php namespace TelegramPro;

final class Video
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $width,
        int $height,
        int $duration,
        ?PhotoSize $thumb,
        ?string $mimeType,
        ?int $fileSize
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromRequest($video): ?Video
    ***REMOVED***
        if ( ! $video) return null;

        return new static(
            $video->file_id,
            $video->file_unique_id,
            $video->width,
            $video->height,
            $video->duration,
            PhotoSize::fromRequest($video->thumb),
            $video->mime_type,
            $video->file_size,
        );
    ***REMOVED***
***REMOVED***