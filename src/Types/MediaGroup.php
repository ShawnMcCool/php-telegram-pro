<?php namespace TelegramPro\Types;

final class MediaGroup
{
    private array $mediaGroup ;

    public function __construct(array $mediaGroup)
    {
        $this->mediaGroup = $mediaGroup;
    }

    public function toApi(): string
    {
        $mediaArray = [];

        /**
         * @var int $key
         * @var InputMedia $media
         */
        foreach ($this->mediaGroup as $key => $media) {
            $mediaArray[] = $media->toApi();
        }

        return json_encode($mediaArray);
    }

    public function filesToUpload(): array
    {
        $mediaArray = [];
        
        /** @var InputMedia $media */
        foreach ($this->mediaGroup as $media) {
            /** @var InputFile $file */
            foreach ($media->filesToUpload() as $field => $file) {
                if ( ! $file) continue;
                $mediaArray[] = $file;
            }
        }
        
        return $mediaArray;
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