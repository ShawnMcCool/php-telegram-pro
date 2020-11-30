<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Types\FileUniqueId;

/**
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 */
final class Animation implements ApiReadType
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $width;
    private int $height;
    private int $duration;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?string $fileSize;

    private function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
        int $width,
        int $height,
        int $duration,
        ?PhotoSize $thumb,
        ?string $fileName,
        ?string $mimeType,
        ?string $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumb = $thumb;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($animation): ?static
    {
        if ( ! $animation) return null;

        return new static(
            FileId::fromApi($animation->file_id),
            FileUniqueId::fromApi($animation->file_unique_id),
            $animation->width,
            $animation->height,
            $animation->duration,
            PhotoSize::fromApi($animation->thumb ?? null),
            $animation->file_name ?? null,
            $animation->mime_type ?? null,
            $animation->file_size ?? null
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
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
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
     * Duration of the video in seconds as defined by sender
     */
    public function duration(): int
    {
        return $this->duration;
    }

    /**
     * Optional. Animation thumbnail as defined by sender
     */
    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    /**
     * Optional. Original animation filename as defined by sender
     */
    public function fileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * Optional. MIME type of the file as defined by sender
     */
    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?string
    {
        return $this->fileSize;
    }
}