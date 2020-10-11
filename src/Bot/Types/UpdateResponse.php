<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ArrayOfUpdates;

final class UpdateResponse implements ApiReadType
{
    private bool $ok;
    private ?ArrayOfUpdates $updates;

    public function __construct(
        bool $ok,
        ?ArrayOfUpdates $updates
    ) {
        $this->ok = $ok;
        $this->updates = $updates;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function updates(): ?ArrayOfUpdates
    {
        return $this->updates;
    }

    public static function fromApi($jsonResponse): ?self
    {
        $response = json_decode($jsonResponse);
        
        return new static(
            $response->ok,
            ArrayOfUpdates::fromApi($response->result)
        );
    }
}