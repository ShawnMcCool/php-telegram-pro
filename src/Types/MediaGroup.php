<?php namespace TelegramPro\Types;

final class MediaGroup
{
    private array $mediaGroup;

    public function __construct(array $mediaGroup)
    {
        $this->mediaGroup = $mediaGroup;
    }

    public function toApi(): string
    {
        $mediaArray = [];

        foreach ($this->mediaGroup as $key => $media) {
            $mediaArray[] = $media->toApi("media_{$key}");
        }

        return json_encode($mediaArray);
    }

    public function files(): array
    {
        $fileArray = [];

        foreach ($this->mediaGroup as $key => $media) {
            /** @var InputMedia $media */
            $fileArray["media_{$key}"] = $media->toFile();
        }

        return $fileArray;
    }

    public static function items(InputMedia ...$items)
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