<?php namespace TelegramPro\Types;

final class LoginUrl
{
    private Url $url;
    private ?string $forwardText;
    private ?string $botUsername;
    private ?bool $requestWriteAccess;

    public function __construct(
        Url $url,
        ?string $forwardText,
        ?string $botUsername,
        ?bool $requestWriteAccess
    ) {
        $this->url = $url;
        $this->forwardText = $forwardText;
        $this->botUsername = $botUsername;
        $this->requestWriteAccess = $requestWriteAccess;
    }

    public static function fromApi($loginUrl): ?LoginUrl
    {
        if ( ! $loginUrl) return null;

        return new static(
            Url::fromString($loginUrl->url),
            $loginUrl->forward_text,
            $loginUrl->bot_username,
            $loginUrl->request_write_access,
        );
    }
}