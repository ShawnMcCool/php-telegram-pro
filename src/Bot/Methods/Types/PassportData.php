<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\EncryptedCredentials;
use TelegramPro\Bot\Types\ArrayOfEncryptedPassportElements;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 */
final class PassportData implements ApiReadType
{
    private function __construct(
        private ArrayOfEncryptedPassportElements $data,
        private EncryptedCredentials $credentials
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($passportData): ?static
    {
        if ( ! $passportData) return null;

        return new static(
            ArrayOfEncryptedPassportElements::fromApi($passportData->data),
            EncryptedCredentials::fromApi($passportData->credentials)
        );
    }

    /**
     * Array with information about documents and other Telegram Passport elements that was shared with the bot
     */
    public function data(): ArrayOfEncryptedPassportElements
    {
        return $this->data;
    }

    /**
     * Encrypted credentials required to decrypt the data
     */
    public function credentials(): EncryptedCredentials
    {
        return $this->credentials;
    }
}