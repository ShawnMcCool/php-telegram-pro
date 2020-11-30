<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Types\ArrayOfMessages;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * On success, an array of the sent Messages is returned.
 */
final class SendMediaGroupResponse implements Response
{
    private bool $ok;
    private ArrayOfMessages $sentMessages;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ArrayOfMessages $sentMessages,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->error = $error;
        $this->sentMessages = $sentMessages;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function sentMessages(): ArrayOfMessages
    {
        return $this->sentMessages;
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
            ArrayOfMessages::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}