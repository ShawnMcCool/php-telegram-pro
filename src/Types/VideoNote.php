<?php namespace TelegramPro\Types;

/**
 * This object represents a video message (available in Telegram apps as of v.4.0).
 */
final class VideoNote implements ApiReadType
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $length;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?int $fileSize;

    private function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
        int $length,
        int $duration,
        ?PhotoSize $thumb,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->length = $length;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileSize = $fileSize;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($videoNote): ?VideoNote
    {
        if ( ! $videoNote) return null;

        return new static(
            FileId::fromApi($videoNote->file_id),
            FileUniqueId::fromApi($videoNote->file_unique_id),
            $videoNote->length,
            $videoNote->duration,
            PhotoSize::fromApi($videoNote->thumb),
            $videoNote->file_size,
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
     * 	Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function fileUniqueId(): FileUniqueId
    {
        return $this->fileUniqueId;
    }

    /**
     * Video width and height (diameter of the video message) as defined by sender
     */
    public function length(): int
    {
        return $this->length;
    }

    /**
     * Duration of the video in seconds as defined by sender
     */
    public function duration(): int
    {
        return $this->duration;
    }

    /**
     * Optional. Video thumbnail
     */
    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}