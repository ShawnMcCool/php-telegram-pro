<?php namespace Tests;

final class TestMedia
{
    private array $images;
    private string $imageUrl;
    private string $mp3Path;
    private string $m4aPath;
    private string $audioUrl;
    private string $documentPath;
    private string $videoPath;
    private string $animationPath;
    private string $animationUrl;
    private string $videoUrl;

    private function __construct(
        array $images,
        string $imageUrl,
        string $mp3Path,
        string $m4aPath,
        string $audioUrl,
        string $documentPath,
        string $videoPath,
        string $videoUrl,
        string $animationPath,
        string $animationUrl
    ) {
        $this->images = $images;
        $this->mp3Path = $mp3Path;
        $this->m4aPath = $m4aPath;
        $this->imageUrl = $imageUrl;
        $this->audioUrl = $audioUrl;
        $this->documentPath = $documentPath;
        $this->videoPath = $videoPath;
        $this->animationPath = $animationPath;
        $this->animationUrl = $animationUrl;
        $this->videoUrl = $videoUrl;
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

    public function document(): string
    {
        return $this->documentPath;
    }

    public function video(): string
    {
        return $this->videoPath;
    }

    public function videoUrl(): string
    {
        return $this->videoUrl;
    }

    public function animation(): string
    {
        return $this->animationPath;
    }

    public function animationUrl(): string
    {
        return $this->animationUrl;
    }

    public static function paths(
        string $imageDirectory,
        string $imageUrl,
        string $mp3Path,
        string $m4aPath,
        string $audioUrl,
        string $documentPath,
        string $videoPath,
        string $videoUrl,
        string $animationPath,
        string $animationUrl
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
        if ( ! file_exists($documentPath)) {
            throw new FileDoesNotExist($documentPath);
        }
        if ( ! file_exists($videoPath)) {
            throw new FileDoesNotExist($videoPath);
        }
        if ( ! file_exists($animationPath)) {
            throw new FileDoesNotExist($animationPath);
        }

        return new static(
            glob(realpath($imageDirectory) . '/*'),
            $imageUrl,
            $mp3Path,
            $m4aPath,
            $audioUrl,
            $documentPath,
            $videoPath,
            $videoUrl,
            $animationPath,
            $animationUrl
        );
    }
}