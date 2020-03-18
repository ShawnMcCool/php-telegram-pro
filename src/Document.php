<?php namespace TelegramPro;

final class Document
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private ?PhotoSize $thumb;
    private ?string $fileName;
    private ?string $mimeType;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
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

    public static function fromRequest($document): ?Document
    ***REMOVED***
        if ( ! $document) return null;

        return new static(
            $document->file_id,
            $document->file_unique_id,
            PhotoSize::fromRequest($document->thumb),
            $document->file_name,
            $document->mime_type,
            $document->file_size
        );
    ***REMOVED***
***REMOVED***