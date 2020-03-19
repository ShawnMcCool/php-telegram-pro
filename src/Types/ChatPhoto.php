<?php namespace TelegramPro\Types;

final class ChatPhoto
{
    private string $smallFileId;
    private string $smallFileUniqueId;
    private string $bigFileId;
    private string $bigFileUniqueId;

    public function __construct(
        string $smallFileId,
        string $smallFileUniqueId,
        string $bigFileId,
        string $bigFileUniqueId
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
            $photo->small_file_id,
            $photo->small_file_unique_id,
            $photo->big_file_id,
            $photo->big_file_unique_id
        );
    }
}