<?php namespace TelegramPro\Bot\Methods\FileUploads;

use ArrayIterator;
use IteratorAggregate;

/**
 * A collection class for FileToUpload objects
 */
final class FilesToUpload implements IteratorAggregate
{
    private function __construct(
        private array $files
    ) {
    }

    public function merge(?FilesToUpload $that): void
    {
        if (is_null($that)) {
            return;
        }

        $this->files = array_merge(
            $this->files,
            $that->files
        );
    }

    /**
     * Array of FileToUpload objects
     */
    public function files(): array
    {
        return $this->files;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->files);
    }

    public static function list(?FileToUpload ...$files): static
    {
        return new static(
            array_filter($files)
        );
    }

    public static function fromArray(array $mediaArray): static
    {
        return new static(
            array_filter($mediaArray)
        );
    }

    public static function empty()
    {
        return new static([]);
    }
}