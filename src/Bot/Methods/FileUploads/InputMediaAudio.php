<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

use JsonSerializable;
use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use function TelegramPro\bytesToMegabytes;

/**
 * Represents an audio file to be treated as music to be sent.
 */
final class InputMediaAudio implements InputMediaFile, JsonSerializable
{
    private string $type = 'audio';
    private AudioInputFile $media;
    private ?ThumbnailInputFile $thumb;
    private ?MediaCaption $caption;
    private ?ParseMode $parseMode;
    private ?int $duration;
    private ?string $performer;
    private ?string $title;

    private function __construct(
        AudioInputFile $media,
        ?ThumbnailInputFile $thumb,
        ?MediaCaption $caption,
        ?ParseMode $parseMode,
        ?int $duration,
        ?string $performer,
        ?string $title
    ) {
        $this->media = $media;
        $this->thumb = $thumb;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->duration = $duration;
        $this->performer = $performer;
        $this->title = $title;
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
                'media' => $this->media,
                'thumb' => $this->thumb,
                'caption' => $this->caption,
                'parse_mode' => $this->parseMode,
                'duration' => $this->duration,
                'performer' => $this->performer,
                'title' => $this->title,
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
     * @param MediaCaption|null $caption Optional. Caption of the audio to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $duration Optional. Duration of the audio in seconds
     * @param string|null $performer Optional. Performer of the audio
     * @param string|null $title Optional. Title of the audio
     *
     * @return static
     */
    public static function fromFileId(
        FileId $fileId,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null
    ): self {
        return new static(
            AudioInputFile::fromFileId($fileId),
            $thumb,
            $caption,
            $parseMode,
            $duration,
            $performer,
            $title
        );
    }

    /**
     * Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     *
     * @param Url $url Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the audio to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $duration Optional. Duration of the audio in seconds
     * @param string|null $performer Optional. Performer of the audio
     * @param string|null $title Optional. Title of the audio
     *
     * @return static
     */
    public static function fromUrl(
        Url $url,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null
    ): self {
        return new static(
            AudioInputFile::fromUrl($url),
            $thumb,
            $caption,
            $parseMode,
            $duration,
            $performer,
            $title
        );
    }

    /**
     * Upload a local file at the given path
     *
     * @param FilePath $filePath Path to the local file
     * @param ThumbnailInputFile|null $thumb Optional. Thumbnail of the file sent
     * @param MediaCaption|null $caption Optional. Caption of the audio to be sent
     * @param ParseMode|null $parseMode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @param int|null $duration Optional. Duration of the audio in seconds
     * @param string|null $performer Optional. Performer of the audio
     * @param string|null $title Optional. Title of the audio
     *
     * @return static
     *
     * @throws AudioFileNotSupported
     */
    public static function fromFilePath(
        FilePath $filePath,
        ?ThumbnailInputFile $thumb = null,
        ?MediaCaption $caption = null,
        ?ParseMode $parseMode = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null
    ): self {
        if (bytesToMegabytes(filesize($filePath)) > 50) {
            throw AudioFileNotSupported::fileSizeIsGreaterThan50Megabyte($filePath);
        }

        if ( ! in_array(
            mime_content_type($filePath),
            [
                'audio/mpeg',
                'audio/mpeg3',
                'audio/x-mpeg-3',
                'audio/m4a',
                'audio/x-m4a',
            ]
        )) {
            throw AudioFileNotSupported::formatNotSupported($filePath, mime_content_type($filePath->toString()));
        }

        return new static(
            AudioInputFile::fromFilePath($filePath),
            $thumb,
            $caption,
            $parseMode,
            $duration,
            $performer,
            $title
        );
    }
}