<?php namespace TelegramPro\Types;

final class Document
***REMOVED***
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
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->thumb = $thumb;
        $this->fileName = $fileName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function fromApi($document): ?Document
    ***REMOVED***
        if ( ! $document) return null;

        return new static(
            $document->file_id,
            $document->file_unique_id ?? null,
            PhotoSize::fromApi($document->thumb ?? null),
            $document->file_name ?? null,
            $document->mime_type ?? null,
            $document->file_size ?? null
        );
    ***REMOVED***

    public function fileId(): string
    ***REMOVED***
        return $this->fileId;
    ***REMOVED***

    public function fileUniqueId(): ?string
    ***REMOVED***
        return $this->fileUniqueId;
    ***REMOVED***

    public function thumb(): ?PhotoSize
    ***REMOVED***
        return $this->thumb;
    ***REMOVED***

    public function fileName(): ?string
    ***REMOVED***
        return $this->fileName;
    ***REMOVED***

    public function mimeType(): ?string
    ***REMOVED***
        return $this->mimeType;
    ***REMOVED***

    public function fileSize(): ?int
    ***REMOVED***
        return $this->fileSize;
    ***REMOVED***
***REMOVED***