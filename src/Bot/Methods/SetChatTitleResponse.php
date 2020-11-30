<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatTitleResponse implements Response
{
    private bool $ok;
    private bool $chatTitleWasSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $chatTitleWasSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->chatTitleWasSet = $chatTitleWasSet;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatTitleWasSet(): bool
    {
        return $this->chatTitleWasSet;
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