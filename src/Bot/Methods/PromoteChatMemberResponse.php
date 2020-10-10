<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class PromoteChatMemberResponse implements Response
{
    private bool $ok;
    private bool $memberChatStatusWasModified;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $memberChatStatusWasModified,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->memberChatStatusWasModified = $memberChatStatusWasModified;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function memberChatStatusWasModified(): bool
    {
        return $this->memberChatStatusWasModified;
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