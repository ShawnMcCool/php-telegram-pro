<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\Date;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
 */
final class PassportFile implements ApiReadType
{
    private FileId $fileId;
    private FileUniqueId $fileUniqueId;
    private int $fileSize;
    private Date $fileDate;

    private function __construct(
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($file): ?PassportFile
    {
        return new static(
            FileId::fromApi($file->file_id),
            FileUniqueId::fromApi($file->file_unique_id),
            $file->file_size,
            Date::fromApi($file->file_date)
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
     * File size
     */
    public function fileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * Unix time when the file was uploaded
     */
    public function fileDate(): Date
    {
        return $this->fileDate;
    }
}