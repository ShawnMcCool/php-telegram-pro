<?php namespace TelegramPro;

final class PassportData
***REMOVED***
    private array $data;
    private EncryptedCredentials $credentials;

    public function __construct(
        array $data, // array of EncryptedPassportElement
        EncryptedCredentials $credentials
    ) ***REMOVED***
        $this->data = $data;
        $this->credentials = $credentials;
    ***REMOVED***

    public static function fromString($passportData): ?PassportData
    ***REMOVED***
        if ( ! $passportData) return null;
        
        return new static(
            EncryptedPassportElement::arrayFromRequest($passportData->data),
            EncryptedCredentials::fromRequest($passportData->credentials)
        );
    ***REMOVED***
***REMOVED***