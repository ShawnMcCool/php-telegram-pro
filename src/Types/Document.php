<?php namespace TelegramPro\Types;

final class Document
{
    private string $fileId;
    private ?string $fileUniqueId;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        ?string $fileUniqueId,
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
            $document->file_id,
            $document->file_unique_id ?? null,
            PhotoSize::fromApi($document->thumb ?? null),
            $document->file_name ?? null,
            $document->mime_type ?? null,
            $document->file_size ?? null
        );
    }

    public function fileId(): string
    {
        return $this->fileId;
    }

    public function fileUniqueId(): ?string
    {
        return $this->fileUniqueId;
    }

    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }

    public function fileName(): ?string
    {
        return $this->fileName;
    }

    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}