<?php namespace TelegramPro\Types;

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
}