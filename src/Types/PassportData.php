<?php namespace TelegramPro\Types;

final class PassportData
{
    private array $data;
    private EncryptedCredentials $credentials;

    public function __construct(
        array $data, // array of EncryptedPassportElement
        EncryptedCredentials $credentials
    ) {
        $this->data = $data;
        $this->credentials = $credentials;
    }

    public static function fromString($passportData): ?PassportData
    {
        if ( ! $passportData) return null;
        
        return new static(
            EncryptedPassportElement::arrayfromApi($passportData->data),
            EncryptedCredentials::fromApi($passportData->credentials)
        );
    }
}