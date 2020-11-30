<?php namespace TelegramPro\Bot\Methods\Types;

final class Dice implements ApiReadType
{
    private string $emoji;
    private int $value;

    public function __construct(
        string $emoji,
        int $value
    ) {
        $this->emoji = $emoji;
        $this->value = $value;
    }

    public static function fromApi($data): ?static
    {
        if (is_null($data)) {
            return null;
        }

        return new static(
            $data->emoji,
            $data->value
        );
    }

    public function emoji(): string
    {
        return $this->emoji;
    }

    public function value(): int
    {
        return $this->value;
    }
}