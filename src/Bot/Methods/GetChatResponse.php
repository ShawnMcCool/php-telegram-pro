<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\Chat;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns a Chat object on success.
 */
final class GetChatResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?Chat $chat,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function chat(): ?Chat
    {
        return $this->chat;
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
            Chat::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}