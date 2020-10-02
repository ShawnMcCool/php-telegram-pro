<?php namespace TelegramPro\Bot\Types;

/*
 * This object represents an audio file to be treated as music by the Telegram clients.
 */
final class Audio implements ApiReadType
{
    private FileId $fileId;
    private ?FileUniqueId $fileUniqueId;
    private int $duration;
    private ?string $performer;
    private ?string $title;
    private ?string $mimeType;
    private ?int $fileSize;
    private ?PhotoSize $thumb;

    private function __construct(
        FileId $fileId,
        ?FileUniqueId $fileUniqueId,
        int $duration,
        ?string $performer,
        ?string $title,
        ?string $mimeType,
        ?int $fileSize,
        ?PhotoSize $thumb
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
        $this->thumb = $thumb;
    }
    
    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($audio): ?Audio
    {
        if ( ! $audio) return null;
        
        return new static(
            FileId::fromApi($audio->file_id),
            FileUniqueId::fromApi($audio->file_unique_id ?? null),
            $audio->duration,
            $audio->performer ?? null,
            $audio->title ?? null,
            $audio->mime_type ?? null,
            $audio->file_size ?? null,
            PhotoSize::fromApi($audio->thumb ?? null)
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
     * 	Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function fileUniqueId(): ?FileUniqueId
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
     * Optional. Performer of the audio as defined by sender or by audio tags
     */
    public function performer(): ?string
    {
        return $this->performer;
    }

    /**
     * Optional. Title of the audio as defined by sender or by audio tags
     */
    public function title(): ?string
    {
        return $this->title;
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

    /**
     * Optional. Thumbnail of the album cover to which the music file belongs
     */
    public function thumb(): ?PhotoSize
    {
        return $this->thumb;
    }
}