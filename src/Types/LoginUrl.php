<?php namespace TelegramPro\Types;

final class LoginUrl
***REMOVED***
    private string $url;
    private ?string $forwardText;
    private ?string $botUsername;
    private ?bool $requestWriteAccess;

    public function __construct(
        string $url,
        ?string $forwardText,
        ?string $botUsername,
        ?bool $requestWriteAccess
    ) ***REMOVED***
        $this->url = $url;
        $this->forwardText = $forwardText;
        $this->botUsername = $botUsername;
        $this->requestWriteAccess = $requestWriteAccess;
    ***REMOVED***

    public static function fromApi($loginUrl): ?LoginUrl
    ***REMOVED***
        if ( ! $loginUrl) return null;

        return new static(
            $loginUrl->url,
            $loginUrl->forward_text,
            $loginUrl->bot_username,
            $loginUrl->request_write_access,
        );
    ***REMOVED***
***REMOVED***