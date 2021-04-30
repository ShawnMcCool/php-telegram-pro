<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Types\FileUniqueId;

/**
 * This object represents a video file.
 */
final class Video implements ApiReadType
{
    private function __construct(
        private FileId $fileId,
        private FileUniqueId $fileUniqueId,
        private int $width,
        private int $height,
        private int $duration,
        private ?PhotoSize $thumb,
        private ?string $mimeType,
        private ?int $fileSize
    ) {
    }

    /**
     * Identifier for this file, which can be used to download or reuse the file
     */
    public function fileId(): FileId
    {
        return $this->fileId;
    }

    /**
     *    Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function fileUniqueId(): FileUniqueId
    {
        return $this->fileUniqueId;
    }

    /**
     * Video width as defined by sender
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Video height as defined by sender
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     *    Duration of the video in seconds as defined by sender
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
     * Optional. Mime type of a file as defined by sender
     */
    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($video): ?static
    {
        if ( ! $video) return null;

        return new static(
            FileId::fromApi($video->file_id),
            FileUniqueId::fromApi($video->file_unique_id),
            $video->width,
            $video->height,
            $video->duration,
            PhotoSize::fromApi($video->thumb ?? null),
            $video->mime_type,
            $video->file_size,
        );
    }
}