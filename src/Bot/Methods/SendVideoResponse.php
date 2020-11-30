<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * On success, the sent Message is returned.
 */
final class SendVideoResponse implements Response
{
    private bool $ok;
    private ?Message $sentMessage;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?Message $sentMessage,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->sentMessage = $sentMessage;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function sentMessage(): ?Message
    {
        return $this->sentMessage;
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
            Message::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}