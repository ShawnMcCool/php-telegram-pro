<?php namespace TelegramPro\Bot\Methods\Types;

final class MethodError
{
    private string $code;
    private string $description;

    public function __construct(
        string $code,
        string $description
    ) {
        $this->code = $code;
        $this->description = $description;
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