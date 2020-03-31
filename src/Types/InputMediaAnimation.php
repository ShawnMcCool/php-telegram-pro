<?php namespace TelegramPro\Types;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 */
final class InputMediaAnimation implements InputMedia
{
    /**
     * Type of the result, must be animation
     */
    private string $type = 'animation';
    /**
     *    File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
     */
    private AnimationFile $media;
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
     * Optional. Animation width
     */
    private ?int $width;
    /**
     * Optional. Animation height
     */
    private ?int $height;
    /**
     *    Optional. Animation duration
     */
    private ?int $duration;

    public function __construct(
        AnimationFile $media,
        ?ThumbnailFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $width,
        ?int $height,
        ?int $duration
    ) {
        $this->media = $media;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
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
        $this->toApi();
    }

    /**
     * Construct an InputMediaAnimation from a file.
     */
    public static function fromAnimationFile(
        AnimationFile $media,
        ?ThumbnailFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null
    ): self {
        return new static(
            $media,
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration
        );
    } 
}