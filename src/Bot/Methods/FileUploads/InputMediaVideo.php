<?php namespace TelegramPro\Bot\Methods\FileUploads;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;

/**
 * This object represents the video content of a media message.
 */
final class InputMediaVideo implements InputMediaFile
{
    private string $type = 'video';
    private VideoFile $media;
    private ?ThumbnailInputFile $thumb;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $width;
    private ?int $height;
    private ?int $duration;
    private ?bool $supportsStreaming;

    private function __construct(
        VideoFile $media,
        ?ThumbnailInputFile $thumb,
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
                'media' => $this->media->toApi(),
                'thumb' => optional($this->thumb),
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
                'width' => $this->width,
                'height' => $this->height,
                'duration' => $this->duration,
                'supports_streaming' => $this->supportsStreaming,
            ]
        );
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
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the video to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Video width
     * @param int|null $height Optional. Video height
     * @param int|null $duration Optional. Video duration
     * @param bool|null $supportsStreaming Optional. Pass True, if the uploaded video is suitable for streaming
     *
     * @return static
     */
    public static function fromFileId(
        FileId $fileId,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?ThumbnailInputFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): self {
        return new static(
            VideoFile::fromFileId($fileId),
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     *
     * @param Url $url Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the video to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Video width
     * @param int|null $height Optional. Video height
     * @param int|null $duration Optional. Video duration
     * @param bool|null $supportsStreaming Optional. Pass True, if the uploaded video is suitable for streaming
     *
     * @return static
     */
    public static function fromUrl(
        Url $url,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?ThumbnailInputFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): self {
        return new static(
            VideoFile::fromUrl($url),
            $thumb,
            $caption,
            $parseMode,
            $width,
            $height,
            $duration,
            $supportsStreaming
        );
    }


    /**
     * Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
     *
     * @param FilePath $filePath Path to the local file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the video to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $width Optional. Video width
     * @param int|null $height Optional. Video height
     * @param int|null $duration Optional. Video duration
     * @param bool|null $supportsStreaming Optional. Pass True, if the uploaded video is suitable for streaming
     *
     * @return static
     *
     * @throws VideoFileNotSupported
     */
    public static function fromFilePath(
        FilePath $filePath,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?ThumbnailInputFile $thumb = null,
        ?int $width = null,
        ?int $height = null,
        ?int $duration = null,
        ?bool $supportsStreaming = null
    ): self {
        return new static(
            VideoFile::fromFilePath($filePath),
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