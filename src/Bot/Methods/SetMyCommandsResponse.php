<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetMyCommandsResponse implements Response
{
    private bool $ok;
    private bool $commandsWereSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $commandsWereSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->commandsWereSet = $commandsWereSet;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function commandsWereSet(): bool
    {
        return $this->commandsWereSet;
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