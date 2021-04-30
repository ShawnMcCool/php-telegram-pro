<?php namespace TelegramPro\Bot\Methods\Types;

final class WebhookInfo implements ApiReadType
{
    public function __construct(
        string $url,
        bool $hasCustomCertificate,
        int $pendingUpdateCount,
        ?string $ipAddress,
        ?Date $lastErrorDate,
        ?string $lastErrorMessage,
        ?int $maxConnections,
        ?ArrayOfStrings $allowedUpdates,
    ) {
    }

    public static function fromApi($response): ?static
    {
        return new static(
            $response->url,
            $response->has_custom_certificate,
            $response->pending_update_count,
            $response->ip_address ?? null,
            Date::fromApi($response->last_error_date ?? null),
            $response->last_error_message ?? null,
            $response->max_connections ?? null,
            ArrayOfStrings::fromApi($response->allowed_updates ?? null),
        );
    }
}