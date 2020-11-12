<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;

/**
 * This object represents the photo content of a media message.
 */
final class InputMediaPhoto implements InputMediaFile
{
    private string $type = 'photo';
    private InputPhotoFile $media;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;

    private function __construct(
        InputPhotoFile $media,
        ?MediaCaption $caption,
        ?ParseMode $parseMode
    ) {
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
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
                'caption' => optional($this->caption),
                'parse_mode' => optional($this->parseMode),
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
            $this->media->fileToUpload()
        );
    }

    /**
     * If the file is already stored somewhere on the Telegram servers, you don't need to reupload it: each file object has a file_id field, simply pass this file_id as a parameter instead of uploading. There are no limits for files sent this way.
     *
     * @param FileId $fileId Identifier for this file, which can be used to download or reuse the file
     * @param MediaCaption|null $caption Optional. Caption of the photo to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     */
    public static function fromFileId(
        FileId $fileId,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            InputPhotoFile::fromFileId($fileId),
            $caption,
            $parseMode
        );
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     *
     * @param Url $url Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     * @param MediaCaption|null $caption Optional. Caption of the photo to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     */
    public static function fromUrl(
        Url $url,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            InputPhotoFile::fromUrl($url),
            $caption,
            $parseMode
        );
    }

    /**
     * Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.
     *
     * @param FilePath $filePath Path to the local file
     * @param MediaCaption|null $caption Optional. Caption of the photo to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     *
     * @return static
     *
     * @throws PhotoFileNotSupported
     */
    public static function fromFilePath(
        FilePath $filePath,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null
    ): self {
        return new static(
            InputPhotoFile::fromFilePath($filePath),
            $caption,
            $parseMode
        );
    }
}