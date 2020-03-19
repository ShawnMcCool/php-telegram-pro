<?php namespace TelegramPro\Types;

final class EncryptedCredentials
{
    private string $data;
    private string $hash;
    private string $secret;

    public function __construct(
        string $data,
        string $hash,
        string $secret
    ) {
        $this->data = $data;
        $this->hash = $hash;
        $this->secret = $secret;
    }

    public static function fromApi($credentials): ?EncryptedCredentials
    {
        if ( ! $credentials) return null;

        return new static(
            $credentials->data,
            $credentials->hash,
            $credentials->secret
        );
    }
}