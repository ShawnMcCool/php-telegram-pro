<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Types\ArrayOfMessages;
use TelegramPro\Bot\Methods\Types\MethodError;

final class SendMediaGroupResponse implements Response
{
    private bool $ok;
    private ArrayOfMessages $result;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ArrayOfMessages $result,
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

    public function botInformation(): ArrayOfMessages
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
            ArrayOfMessages::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}