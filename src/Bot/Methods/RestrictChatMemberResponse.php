<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class RestrictChatMemberResponse implements Response
{
    private bool $ok;
    private bool $memberWasRestricted;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $memberWasRestricted,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->memberWasRestricted = $memberWasRestricted;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function memberWasRestricted(): bool
    {
        return $this->memberWasRestricted;
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