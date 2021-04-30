<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns Int on success.
 */
final class GetChatMembersCountResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?int $memberCount,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function memberCount(): ?int
    {
        return $this->memberCount;
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
            $response->result ?? null,
            MethodError::fromApi($response)
        );
    }
}