<?php namespace TelegramPro\Methods\FileUploads;

use JsonSerializable;
use TelegramPro\Types\Url;
use TelegramPro\Types\FileId;
use TelegramPro\Methods\ParseMode;
use TelegramPro\Types\MediaCaption;

/**
 * Represents a general file to be sent.
 */
final class InputMediaDocument implements InputMediaFile, JsonSerializable
{
    private string $type = 'document';
    private DocumentFile $media;
    private ?ThumbnailInputFile $thumb;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;

    private function __construct(
        DocumentFile $media,
        ?ThumbnailInputFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode
    ) {
        $this->media = $media;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public function toApi(): array
    {
        return array_filter(
            [
                'type' => $this->type,
                'media' => $this->media,
                'thumb' => $this->thumb,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
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
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the document to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     */
    public static function fromFileId(
        FileId $fileId,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            DocumentFile::fromFileId($fileId),
            $thumb,
            $caption,
            $parseMode
        );
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     *
     * @param Url $url Path to the local file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the document to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     */
    public static function fromUrl(
        Url $url,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            DocumentFile::fromUrl($url),
            $thumb,
            $caption,
            $parseMode
        );
    }

    /**
     * Upload a local file at the given path
     *
     * @param FilePath $filePath Path to the local file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the document to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     *
     * @throws DocumentFileNotSupported
     */
    public static function fromFilePath(
        FilePath $filePath,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            DocumentFile::fromFilePath($filePath),
            $thumb,
            $caption,
            $parseMode
        );
    }
}