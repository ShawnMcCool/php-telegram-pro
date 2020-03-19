<?php namespace Tests;

final class TestMedia
{
    private array $images;
    private string $imageUrl;
    private string $mp3Path;
    private string $m4aPath;
    private string $audioUrl;

    private function __construct(
        array $images,
        string $imageUrl,
        string $mp3Path,
        string $m4aPath,
        string $audioUrl
    ) {
        $this->images = $images;
        $this->mp3Path = $mp3Path;
        $this->m4aPath = $m4aPath;
        $this->imageUrl = $imageUrl;
        $this->audioUrl = $audioUrl;
    }

    public function image(): string
    {
        $key = array_rand($this->images, 1);
        return $this->images[$key];
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function mp3(): string
    {
        return $this->mp3Path;
    }

    public function audioUrl(): string
    {
        return $this->audioUrl;
    }

    public function m4a(): string
    {
        return $this->m4aPath;
    }

    public static function paths(
        string $imageDirectory,
        string $imageUrl,
        string $mp3Path,
        string $m4aPath,
        string $audioUrl
    ) {
        if ( ! realpath($imageDirectory)) {
            throw new DirectoryDoesNotExist($imageDirectory);
        }
        if ( ! file_exists($mp3Path)) {
            throw new FileDoesNotExist($mp3Path);
        }
        if ( ! file_exists($m4aPath)) {
            throw new FileDoesNotExist($m4aPath);
        }

        return new static(
            glob(realpath($imageDirectory) . '/*'),
            $imageUrl,
            $mp3Path,
            $m4aPath,
            $audioUrl
        );
    }
}