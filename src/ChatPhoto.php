<?php namespace TelegramPro;

final class ChatPhoto
***REMOVED***
    private string $smallFileId;
    private string $smallFileUniqueId;
    private string $bigFileId;
    private string $bigFileUniqueId;

    public function __construct(
        string $smallFileId,
        string $smallFileUniqueId,
        string $bigFileId,
        string $bigFileUniqueId
    ) ***REMOVED***
        $this->smallFileId = $smallFileId;
        $this->smallFileUniqueId = $smallFileUniqueId;
        $this->bigFileId = $bigFileId;
        $this->bigFileUniqueId = $bigFileUniqueId;
    ***REMOVED***

    public static function fromRequest($photo): ?ChatPhoto
    ***REMOVED***
        if ( ! $photo) return null;

        return new static(
            $photo->small_file_id,
            $photo->small_file_unique_id,
            $photo->big_file_id,
            $photo->big_file_unique_id
        );
    ***REMOVED***
***REMOVED***