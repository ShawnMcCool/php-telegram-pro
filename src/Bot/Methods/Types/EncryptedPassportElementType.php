<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
 */
final class EncryptedPassportElementType
{
    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public function toString(): string
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public static function fromApi($type): self
    {
        $validTypes = [
            'personal_details', 'passport', 'driver_license', 'identity_card', 'internal_passport',
            'address', 'utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration',
            'temporary_registration', 'phone_number', 'email',
        ];

        if ( ! in_array($type, $validTypes)) {
            throw new EncryptedPassportElementTypeNotSupported($type);
        }

        return new static($type);
    }
}