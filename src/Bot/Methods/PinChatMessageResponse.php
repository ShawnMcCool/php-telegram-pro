<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class PinChatMessageResponse implements Response
{
    private bool $ok;
    private bool $messageWasPinned;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $messageWasPinned,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->messageWasPinned = $messageWasPinned;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function messageWasPinned(): bool
    {
        return $this->messageWasPinned;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): self
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            $response->result ?? false,
            MethodError::fromApi($response)
        );
    }
}