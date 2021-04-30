<?php namespace TelegramPro\Bot\Methods\Types;

final class MethodError
{

    public function __construct(
        private string $code,
        private string $description
    ) {
    }

    public function code(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }

    public static function fromApi($response): ?MethodError
    {
        if ($response->ok) {
            return null;
        }

        return new static(
            $response->error_code,
            $response->description
        );
    }
}