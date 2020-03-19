<?php namespace TelegramPro\Types;

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

    public static function arrayfromApi(?array $files): ?array
    ***REMOVED***
        if ( ! $files) return null;

        $fileArray = [];

        foreach ($files as $file) ***REMOVED***
            $fileArray[] = PassportFile::fromApi($file);
        ***REMOVED***

        return $fileArray;
    ***REMOVED***

    public static function fromApi($file): ?PassportFile
    ***REMOVED***
        return new static(
            $file->file_id,
            $file->file_unique_id,
            $file->file_size,
            $file->file_date,
        );
    ***REMOVED***
***REMOVED***