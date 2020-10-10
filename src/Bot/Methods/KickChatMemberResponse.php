<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class KickChatMemberResponse implements Response
{
    private bool $ok;
    private bool $memberWasKicked;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $actionWasSent,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->memberWasKicked = $actionWasSent;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function memberWasKicked(): bool
    {
        return $this->memberWasKicked;
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