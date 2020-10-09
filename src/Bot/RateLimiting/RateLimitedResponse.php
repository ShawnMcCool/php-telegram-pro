<?php namespace TelegramPro\Bot\RateLimiting;

use TelegramPro\Bot\Methods\Response;
use TelegramPro\Bot\Methods\Types\MethodError;

final class RateLimitedResponse implements Response
{
    private bool $ok;
    private ?MethodError $error;
    private string $json;

    public function __construct(
        bool $ok,
        ?MethodError $error,
        string $json
    ) {
        $this->ok = $ok;
        $this->error = $error;
        $this->json = $json;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public function json(): string
    {
        return $this->json;
    }
    
    static function fromApi(string $jsonResponse): self
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            MethodError::fromApi($response),
            $jsonResponse
        );
    }
}