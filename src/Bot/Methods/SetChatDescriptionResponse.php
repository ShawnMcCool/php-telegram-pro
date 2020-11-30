<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatDescriptionResponse implements Response
{
    private bool $ok;
    private bool $chatDescriptionWasSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $chatDescriptionWasSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->chatDescriptionWasSet = $chatDescriptionWasSet;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatDescriptionWasSet(): bool
    {
        return $this->chatDescriptionWasSet;
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