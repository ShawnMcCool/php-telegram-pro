<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Message;

final class SendPhotoResponse
{
    private bool $ok;
    private ?Message $result;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?Message $result,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->result = $result;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function result(): ?Message
    {
        return $this->result;
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
            Message::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}