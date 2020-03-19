<?php namespace TelegramPro\Methods;

use TelegramPro\Types\User;

final class GetMeResponse
{
    private bool $ok;
    private ?User $result;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?User $result,
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

    public function result(): ?User
    {
        return $this->result;
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