<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ArrayOfUpdates;

final class UpdateResponse implements ApiReadType
{

    public function __construct(
        private bool $ok,
        private ?ArrayOfUpdates $updates
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function updates(): ?ArrayOfUpdates
    {
        return $this->updates;
    }

    public static function fromApi($jsonResponse): ?static
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            ArrayOfUpdates::fromApi($response->result)
        );
    }
}