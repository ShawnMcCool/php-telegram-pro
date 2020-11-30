<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class DeleteChatPhotoResponse implements Response
{
    private bool $ok;
    private bool $chatPhotoWasDeleted;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $chatPhotoWasDeleted,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->chatPhotoWasDeleted = $chatPhotoWasDeleted;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatPhotoWasDeleted(): bool
    {
        return $this->chatPhotoWasDeleted;
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
            $response->result ?? false,
            MethodError::fromApi($response)
        );
    }
}