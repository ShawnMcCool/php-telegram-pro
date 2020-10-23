<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatStickerSetResponse implements Response
{
    private bool $ok;
    private ?bool $chatStickerSetWasSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?bool $chatStickerSetWasSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->chatStickerSetWasSet = $chatStickerSetWasSet;
        $this->error = $error;
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

    public static function fromApi(string $jsonResponse): self
    {
        $response = json_decode($jsonResponse);
dd($response);
        return new static(
            $response->ok,
            $response->result,
            MethodError::fromApi($response)
        );
    }
}