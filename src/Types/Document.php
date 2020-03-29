<?php namespace TelegramPro\Types;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 */
final class Document
{
    private FileId $fileId;
    private ?FileUniqueId $fileUniqueId;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        FileId $fileId,
        ?FileUniqueId $fileUniqueId,
        ?PhotoSize $thumb,
        ?string $fileName,
        ?string $mimeType,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->thumb = $thumb;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public static function fromApi($document): ?Document
    {
        if ( ! $document) return null;

        return new static(
            FileId::fromString($document->file_id),
            FileUniqueId::fromString($document->file_unique_id ?? null),
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