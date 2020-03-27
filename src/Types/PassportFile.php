<?php namespace TelegramPro\Types;

final class PassportFile
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $fileSize;
    private Date $fileDate;

    public function __construct(
        FileId $fileId,
        FileUniqueId $fileUniqueId,
        int $fileSize,
        Date $fileDate
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->fileSize = $fileSize;
        $this->fileDate = $fileDate;
    }

    public static function fromApi($file): ?PassportFile
    {
        return new static(
            FileId::fromString($file->file_id),
            FileUniqueId::fromString($file->file_unique_id),
            $file->file_size,
            Date::fromApi($file->file_date)
        );
    }
}