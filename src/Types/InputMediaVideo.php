<?php namespace TelegramPro\Types;

/**
 * Represents a video to be sent.
 */
final class InputMediaVideo implements InputMedia
{
    /**
     * Type of the result, must be video
     */
    private string $type = 'video';
    /**
     *    File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
     */
    private VideoFile $media;
    /**
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     */
    private ?ThumbnailFile $thumb;
    /**
     * Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     */
    private ?MediaCaption $caption;
    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    private ?ParseMode $parseMode;
    /**
     * Optional. Video width
     */
    private ?int $width;
    /**
     * Optional. Video height
     */
    private ?int $height;
    /**
     * Optional. Video duration
     */
    private ?int $duration;
    /**
     * Optional. Pass True, if the uploaded video is suitable for streaming
     */
    private ?bool $supportsStreaming;

    private function __construct(
        VideoFile $media,
        ?ThumbnailFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $width,
        ?int $height,
        ?int $duration,
        ?bool $supportsStreaming
    ) {
        $this->media = $media;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->supportsStreaming = $supportsStreaming;
    }

    public function toApi(): array
    {
        return array_filter(
            [
                'type' => $this->type,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'width' => $this->width,
                'height' => $this->height,
                'duration' => $this->duration,
                'supports_streaming' => $this->supportsStreaming,
                'media' => $this->media,
                'thumb' => $this->thumb,
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
     * Construct an InputMediaVideo from a Telegram file id.
     */
    public static function fromVideoFile(
        VideoFile $video,
        ?MediaCaption $caption = null,
        ?ThumbnailFile $thumb = null,
        ?ParseMode $parseMode = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): InputMediaVideo {
        return new static(
            $video,
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }
}