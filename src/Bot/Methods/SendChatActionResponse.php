<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns True on success.
 */
final class SendChatActionResponse implements Response
{
    private bool $ok;
    private bool $actionWasSent;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        bool $actionWasSent,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->actionWasSent = $actionWasSent;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function actionWasSent(): bool
    {
        return $this->actionWasSent;
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
            $response->result ?? false,
            MethodError::fromApi($response)
        );
    }
}