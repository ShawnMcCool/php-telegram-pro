<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class DeleteChatStickerSetResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?bool $chatStickerSetWasDeleted,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatStickerSetWasDeleted(): ?bool
    {
        return $this->chatStickerSetWasDeleted;
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
            $response->result ?? null,
            MethodError::fromApi($response)
        );
    }
}