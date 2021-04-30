<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\WebhookInfo;

/**
 * Returns basic information about the webohok
 */
final class GetWebhookInfoResponse implements Response
{
    public function __construct(
        private bool $ok,
        private ?WebhookInfo $webhookInfo,
        private ?MethodError $error,
    ) {
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public function webhookInfo(): ?WebhookInfo
    {
        return $this->webhookInfo;
    }

    static function fromApi(string $jsonResponse)
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            WebhookInfo::fromApi($response->result ?? null),
            MethodError::fromApi($response),
        );
    }
}