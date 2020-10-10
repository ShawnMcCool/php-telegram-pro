<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns the new invite link as String on success.
 */
final class ExportChatInviteLinkResponse implements Response
{
    private bool $ok;
    private string $newInviteLink;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        string $newInviteLink,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->newInviteLink = $newInviteLink;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function newInviteLink(): string
    {
        return $this->newInviteLink;
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