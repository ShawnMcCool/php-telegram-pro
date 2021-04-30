<?php namespace TelegramPro\Bot\Methods\FileUploads;

use JsonSerializable;
use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 */
final class InputMediaAnimation implements InputMediaFile, JsonSerializable
{
    private string $type = 'animation';

    private function __construct(
        private AnimationFile $media,
        private ?ThumbnailInputFile $thumb,
        private ?MediaCaption $caption,
        private ?ParseMode $parseMode,
        private ?int $width,
        private ?int $height,
        private ?int $duration
    ) {
    }

    /**
     * Construct with data to be sent to the Telegram bot api.
     *
     * @return array
     */
    public function toApi(): array
    {
        return array_filter(
            [
                'type' => $this->type,
                'thumb' => $this->thumb,
                'media' => $this->media,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'width' => $this->width,
                'height' => $this->height,
                'duration' => $this->duration,
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toApi();
    }

    /**
     * A collection of files to be uploaded.
     *
     * This method is used internally to upload files via http.
     *
     * @return FilesToUpload
     */
    public function filesToUpload(): FilesToUpload
    {
        return FilesToUpload::list(
            $this->media->fileToUpload(),
            $this->thumb ? $this->thumb->fileToUpload() : null
        );
    }


    /**
     * If the file is already stored somewhere on the Telegram servers, you don't need to reupload it: each file object has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files sent this way.
     *
     * @param FileId $fileId Identifier for this file, which can be used to download or reuse the file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side.
     * @param MediaCaption|null $caption Optional. Caption of the animation to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Animation width
     * @param int|null $height Optional. Animation height
     * @param int|null $duration Optional. Animation duration
     *
     * @return static
     */
    public static function fromFileId(
        FileId $fileId,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null
    ): static {
        return new static(
            AnimationFile::fromFileId($fileId),
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration
        );
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     *
     * @param Url $url Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side.
     * @param MediaCaption|null $caption Optional. Caption of the animation to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Animation width
     * @param int|null $height Optional. Animation height
     * @param int|null $duration Optional. Animation duration
     *
     * @return static
     */
    public static function fromUrl(
        Url $url,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null
    ): static {
        return new static(
            AnimationFile::fromUrl($url),
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration
        );
    }

    /**
     * Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
     *
     * @param FilePath $filePath Path to the local file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side.
     * @param MediaCaption|null $caption Optional. Caption of the animation to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Animation width
     * @param int|null $height Optional. Animation height
     * @param int|null $duration Optional. Animation duration
     *
     * @return static
     *
     * @throws AnimationFileNotSupported
     */
    public static function fromFilePath(
        FilePath $filePath,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null
    ): static {
        return new static(
            AnimationFile::fromFilePath($filePath),
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration
        );
    }
}