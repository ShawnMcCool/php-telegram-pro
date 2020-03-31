<?php namespace TelegramPro\Types;

/**
 * This object represents a chat photo.
 */
final class ChatPhoto
{
    private FileId $smallFileId;
    private FileUniqueId $smallFileUniqueId;
    private FileId $bigFileId;
    private FileUniqueId $bigFileUniqueId;

    public function __construct(
        FileId $smallFileId,
        FileUniqueId $smallFileUniqueId,
        FileId $bigFileId,
        FileUniqueId $bigFileUniqueId
    ) {
        $this->smallFileId = $smallFileId;
        $this->smallFileUniqueId = $smallFileUniqueId;
        $this->bigFileId = $bigFileId;
        $this->bigFileUniqueId = $bigFileUniqueId;
    }

    /**
     * Construct with data received from the Telegram bot api.
     */
    public static function fromApi($photo): ?ChatPhoto
    {
        if ( ! $photo) return null;

        return new static(
            FileId::fromString($photo->small_file_id),
            FileUniqueId::fromString($photo->small_file_unique_id),
            FileId::fromString($photo->big_file_id),
            FileUniqueId::fromString($photo->big_file_unique_id)
        );
    }

    /**
     * File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     */
    public function smallFileId(): FileId
    {
        return $this->smallFileId;
    }

    /**
     * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function smallFileUniqueId(): FileUniqueId
    {
        return $this->smallFileUniqueId;
    }

    /**
     * File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     */
    public function bigFileId(): FileId
    {
        return $this->bigFileId;
    }

    /**
     * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function bigFileUniqueId(): FileUniqueId
    {
        return $this->bigFileUniqueId;
    }
}