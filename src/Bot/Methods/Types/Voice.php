<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Types\FileUniqueId;

/**
 * This object represents a voice note.
 */
final class Voice implements ApiReadType
{
    private FileId $fileId;
    private ?FileUniqueId $fileUniqueId;
    private int $duration;
    private ?string $mimeType;
    private ?int $fileSize;

    private function __construct(
        FileId $fileId,
        ?FileUniqueId $fileUniqueId,
        int $duration,
        ?string $mimeType,
        ?int $fileSize
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($voice): ?static
    {
        if ( ! $voice) return null;

        return new static(
            FileId::fromApi($voice->file_id),
            FileUniqueId::fromApi($voice->file_unique_id ?? null),
            $voice->duration,
            $voice->mime_type ?? null,
            $voice->file_size ?? null
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
    public function fileUniqueId(): ?string
    {
        return $this->fileUniqueId;
    }

    /**
     * Duration of the audio in seconds as defined by sender
     */
    public function duration(): int
    {
        return $this->duration;
    }

    /**
     * Optional. MIME type of the file as defined by sender
     */
    public function mimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Optional. File size
     */
    public function fileSize(): ?int
    {
        return $this->fileSize;
    }
}