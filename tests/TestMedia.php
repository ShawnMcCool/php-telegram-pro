<?php namespace Tests;

final class TestMedia
{
    private array $images;

    private function __construct(
        array $images
    ) {
        $this->images = $images;
    }

    public static function paths(
        string $imagePath
    ) {
        if ( ! realpath($imagePath)) {
            throw new DirectoryDoesNotExist($imagePath);
        }
        
        return new static(
            glob(realpath($imagePath) . '/*')
        );
    }

    public function image(): string
    {
        $key = array_rand($this->images, 1);
        return $this->images[$key];
    }
}