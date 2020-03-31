<?php namespace TelegramPro\Types;

/**
 * Represents an audio file to be treated as music to be sent.
 */
final class InputMediaAudio implements InputMedia
{
    /**
     * Type of the result, must be audio
     */
    private string $type = 'audio';
    /**
     *    File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
     */
    private AudioFile $media;
    /**
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     */
    private ?ThumbnailFile $thumb;
    /**
     * Optional. Caption of the animation to be sent, 0-1024 characters after entities parsing
     */
    private ?MediaCaption $caption;
    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    private ?ParseMode $parseMode;
    /**
     *    Optional. Animation duration
     */
    private ?int $duration;
    /**
     * Optional. Performer of the audio
     */
    private ?string $performer;
    /**
     * Optional. Title of the audio
     */
    private ?string $title;

    public function __construct(
        AudioFile $media,
        ?ThumbnailFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?int $performer,
        ?int $title
    ) {
        $this->media = $media;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
    }

    public function toApi(): array
    {
        return array_filter(
            [
                'type' => $this->type,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'duration' => $this->duration,
                'performer' => $this->performer,
                'title' => $this->title,
            ]
        );
    }

    public function filesToUpload(): array
    {
        return [
            'media' => $this->media,
            'thumb' => $this->thumb,
        ];
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toApi();
    }

    /**
     * Construct an InputMediaAudio from a file.
     */
    public static function fromAudioFile(
        AudioFile $media,
        ?ThumbnailFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?int $performer = null,
        ?int $title = null
    ): self {
        return new static(
            $media,
            $thumb,
            $caption,
            $parseMode,
            $duration,
            $performer,
            $title
        );
    }
}