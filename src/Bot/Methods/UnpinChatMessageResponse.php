<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class UnpinChatMessageResponse implements Response
{

    public function __construct(
        private bool $ok,
        private bool $messageWasUnpinned,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function messageWasUnpinned(): bool
    {
        return $this->messageWasUnpinned;
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