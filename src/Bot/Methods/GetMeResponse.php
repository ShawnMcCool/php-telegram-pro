<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns basic information about the bot in form of a User object.
 */
final class GetMeResponse implements Response
{
    public function __construct(
        private bool $ok,
        private ?User $botInformation,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function botInformation(): ?User
    {
        return $this->botInformation;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): GetMeResponse
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            User::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}