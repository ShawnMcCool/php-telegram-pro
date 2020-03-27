<?php namespace TelegramPro\Types;

final class PassportData
{
    private ArrayOfEncryptedPassportElements $data;
    private EncryptedCredentials $credentials;

    public function __construct(
        ArrayOfEncryptedPassportElements $data,
        EncryptedCredentials $credentials
    ) {
        $this->data = $data;
        $this->credentials = $credentials;
    }

    public static function fromString($passportData): ?PassportData
    {
        if ( ! $passportData) return null;
        
        return new static(
            ArrayOfEncryptedPassportElements::fromApi($passportData->data),
            EncryptedCredentials::fromApi($passportData->credentials)
        );
    }
}