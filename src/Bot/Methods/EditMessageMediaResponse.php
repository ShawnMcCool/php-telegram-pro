<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 */
final class EditMessageMediaResponse implements Response
{

    public function __construct(
        private bool $ok,
        private ?Message $editedMessage,
        private ?MethodError $error
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function editedMessage(): ?Message
    {
        return $this->editedMessage;
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