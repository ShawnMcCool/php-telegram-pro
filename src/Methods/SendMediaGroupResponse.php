<?php namespace TelegramPro\Methods;

use TelegramPro\Types\Message;

final class SendMediaGroupResponse
{
    private bool $ok;
    private ?array $result;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?array $result,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->error = $error;
        $this->result = $result;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function result(): ?array
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
            Message::arrayFromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}