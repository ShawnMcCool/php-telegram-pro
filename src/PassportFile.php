<?php namespace TelegramPro;

final class PassportFile
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $fileSize;
    private int $fileDate;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $fileSize,
        int $fileDate
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->fileSize = $fileSize;
        $this->fileDate = $fileDate;
    ***REMOVED***

    public static function arrayFromRequest(?array $files): ?array
    ***REMOVED***
        if ( ! $files) return null;

        $fileArray = [];

        foreach ($files as $file) ***REMOVED***
            $fileArray[] = PassportFile::fromRequest($file);
        ***REMOVED***

        return $fileArray;
    ***REMOVED***

    public static function fromRequest($file): ?PassportFile
    ***REMOVED***
        return new static(
            $file->file_id,
            $file->file_unique_id,
            $file->file_size,
            $file->file_date,
        );
    ***REMOVED***
***REMOVED***