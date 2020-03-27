<?php namespace TelegramPro\Types;

final class PassportFile
{
    private string $fileId;
    private string $fileUniqueId;
    private int $fileSize;
    private int $fileDate;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $fileSize,
        int $fileDate
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->fileSize = $fileSize;
        $this->fileDate = $fileDate;
    }

    public static function fromApi($file): ?PassportFile
    {
        return new static(
            $file->file_id,
            $file->file_unique_id,
            $file->file_size,
            $file->file_date,
        );
    }
}