<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Methods\FileUploads\InputFile;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;
use TelegramPro\Bot\Methods\FileUploads\InputMediaFile;
use TelegramPro\Bot\Methods\FileUploads\InputMediaPhoto;
use TelegramPro\Bot\Methods\FileUploads\InputMediaVideo;

/**
 * A value object representing a media group for the sendMediaGroup method.
 */
final class MediaGroup implements ApiWriteType
{
    private array $mediaGroup;

    public function __construct(array $mediaGroup)
    {
        $this->mediaGroup = $mediaGroup;
    }

    public function toApi(): string
    {
        $mediaArray = [];

        /**
         * @var int $key
         * @var InputMediaFile $media
         */
        foreach ($this->mediaGroup as $key => $media) {
            $mediaArray[] = $media->toApi();
        }

        return json_encode($mediaArray);
    }

    public function filesToUpload(): FilesToUpload
    {
        $mediaArray = [];

        /** @var InputMediaFile $media */
        foreach ($this->mediaGroup as $media) {

            /** @var InputFile $file */
            foreach ($media->filesToUpload() as $file) {
                if ( ! $file) continue;
                $mediaArray[] = $file;
            }
        }

        return FilesToUpload::fromArray($mediaArray);
    }

    public static function items(InputMediaFile ...$items)
    {
        if (count($items) < 2) {
            throw CanNotGroupMediaFiles::mediaGroupsMustHaveTwoOrMoreItems();
        }

        foreach ($items as $item) {
            if ( ! $item instanceof InputMediaPhoto && ! $item instanceof InputMediaVideo) {
                throw CanNotGroupMediaFiles::mediaFileNotSupported(get_class($item));
            }
        }

        return new static($items);
    }
}