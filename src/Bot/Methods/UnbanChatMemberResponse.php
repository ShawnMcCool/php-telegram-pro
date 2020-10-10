<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class UnbanChatMemberResponse implements Response
{
    private bool $ok;
    private bool $memberWasUnbanned;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $memberWasUnbanned,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->memberWasUnbanned = $memberWasUnbanned;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function memberWasUnbanned(): bool
    {
        return $this->memberWasUnbanned;
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