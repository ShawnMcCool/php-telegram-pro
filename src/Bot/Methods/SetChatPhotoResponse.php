<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatPhotoResponse implements Response
{
    private bool $ok;
    private bool $profileChatWasSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $profileChatWasSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->profileChatWasSet = $profileChatWasSet;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function profileChatWasSet(): bool
    {
        return $this->profileChatWasSet;
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