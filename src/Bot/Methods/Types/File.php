<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\FileUniqueId;

final class File implements ApiReadType
{

    public function __construct(
        private FileId $fileId,
        private FileUniqueId $fileUniqueId,
        private ?int $fileSize,
        private ?string $filePath
    ) {
    }

    public static function fromApi($file): ?static
    {
        if ( ! $file) return null;

        return new static(
            FileId::fromApi($file->file_id),
            FileUniqueId::fromApi($file->file_unique_id ?? null),
            $file->file_size ?? null,
            $file->file_path ?? null
        );
    }

    public function fileId(): FileId
    {
        return $this->fileId;
    }

    public function fileUniqueId(): FileUniqueId
    {
        return $this->fileUniqueId;
    }

    public function fileSize(): ?int
    {
        return $this->fileSize;
    }

    public function filePath(): ?string
    {
        return $this->filePath;
    }
}