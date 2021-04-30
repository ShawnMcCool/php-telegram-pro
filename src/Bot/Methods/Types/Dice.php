<?php namespace TelegramPro\Bot\Methods\Types;

final class Dice implements ApiReadType
{

    public function __construct(
        private string $emoji,
        private int $value
    ) {
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