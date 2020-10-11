<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class LeaveChatResponse implements Response
{
    private bool $ok;
    private bool $chatWasLeft;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $chatWasLeft,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->chatWasLeft = $chatWasLeft;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatWasLeft(): bool
    {
        return $this->chatWasLeft;
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