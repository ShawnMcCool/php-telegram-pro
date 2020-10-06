<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
 * https://core.telegram.org/passport#receiving-information
 */
final class EncryptedCredentials implements ApiReadType
{
    private string $data;
    private string $hash;
    private string $secret;

    private function __construct(
        string $data,
        string $hash,
        string $secret
    ) {
        $this->data = $data;
        $this->hash = $hash;
        $this->secret = $secret;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($credentials): ?EncryptedCredentials
    {
        if ( ! $credentials) return null;

        return new static(
            $credentials->data,
            $credentials->hash,
            $credentials->secret
        );
    }

    /**
     * 	Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     */
    public function data(): string
    {
        return $this->data;
    }

    /**
     * Base64-encoded data hash for data authentication
     */
    public function hash(): string
    {
        return $this->hash;
    }

    /**
     * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     */
    public function secret(): string
    {
        return $this->secret;
    }
}