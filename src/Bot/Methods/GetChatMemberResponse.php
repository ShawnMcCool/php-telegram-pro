<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\ChatMember;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns a ChatMember object on success.
 */
final class GetChatMemberResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?ChatMember $chatMember,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chatMember(): ?ChatMember
    {
        return $this->chatMember;
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
            ChatMember::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}