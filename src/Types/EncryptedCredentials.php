<?php namespace TelegramPro\Types;

final class EncryptedCredentials
***REMOVED***
    private string $data;
    private string $hash;
    private string $secret;

    public function __construct(
        string $data,
        string $hash,
        string $secret
    ) ***REMOVED***
        $this->data = $data;
        $this->hash = $hash;
        $this->secret = $secret;
    ***REMOVED***

    public static function fromApi($credentials): ?EncryptedCredentials
    ***REMOVED***
        if ( ! $credentials) return null;

        return new static(
            $credentials->data,
            $credentials->hash,
            $credentials->secret
        );
    ***REMOVED***
***REMOVED***