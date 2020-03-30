<?php namespace TelegramPro\Types;

/**
 * Represents a photo to be sent.
 */
final class InputMediaPhoto implements InputMedia
{
    /**
     * Type of the result, must be photo
     */
    private $type = 'photo';
    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
     */
    private PhotoFile $media;
    /**
     * Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     */
    private ?MediaCaption $caption;
    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     */
    private ?ParseMode $parseMode;

    private function __construct(
        PhotoFile $media,
        ?MediaCaption $caption,
        ?ParseMode $parseMode
    ) {
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
    }

    public function toApi(): array
    {
        return array_filter(
            [
                'type' => $this->type,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'media' => $this->media,
            ]
        );
    }

    public function filesToUpload(): array
    {
        return [
            'media' => $this->media
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
     * Construct an InputMediaPhoto from a Telegram file id.
     */
    public static function fromPhotoFile(
        PhotoFile $photo,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): InputMediaPhoto {
        return new static(
            $photo,
            $caption,
            $parseMode
        );
    }
}