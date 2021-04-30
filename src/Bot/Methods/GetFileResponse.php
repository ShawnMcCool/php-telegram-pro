<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\File;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
 */
final class GetFileResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?File $file,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function file(): ?File
    {
        return $this->file;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): static
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            File::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}