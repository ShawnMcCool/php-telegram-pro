<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatPermissionsResponse implements Response
{

    public function __construct(
        private bool $ok,
        private bool $permissionsWereSet,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function permissionsWereSet(): bool
    {
        return $this->permissionsWereSet;
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