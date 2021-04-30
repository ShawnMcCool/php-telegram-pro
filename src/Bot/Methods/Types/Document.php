<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\PhotoSize;
use TelegramPro\Bot\Types\FileUniqueId;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 */
final class Document implements ApiReadType
{
    private function __construct(
        private FileId $fileId,
        private ?FileUniqueId $fileUniqueId,
        private ?PhotoSize $thumb,
        private ?string $fileName,
        private ?string $mimeType,
        private ?int $fileSize
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($document): ?static
    {
        if ( ! $document) return null;

        return new static(
            FileId::fromApi($document->file_id),
            FileUniqueId::fromApi($document->file_unique_id ?? null),
            PhotoSize::fromApi($document->thumb ?? null),
            $document->file_name ?? null,
            $document->mime_type ?? null,
            $document->file_size ?? null
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
    public function fileUniqueId(): ?FileUniqueId
    {
        return $this->fileUniqueId;
    }

    /**
     * Optional. Document thumbnail as defined by sender
     */
    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    /**
     * Optional. Original filename as defined by sender
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
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}