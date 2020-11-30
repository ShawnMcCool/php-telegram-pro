<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SetChatAdministratorCustomTitleResponse implements Response
{
    private bool $ok;
    private bool $customTitleWasSet;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $customTitleWasSet,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->customTitleWasSet = $customTitleWasSet;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function customTitleWasSet(): bool
    {
        return $this->customTitleWasSet;
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