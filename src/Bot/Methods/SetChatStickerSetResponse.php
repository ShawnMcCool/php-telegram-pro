<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatStickerSetResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?bool $chatStickerSetWasSet,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatStickerSetWasSet(): ?bool
    {
        return $this->chatStickerSetWasSet;
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