<?php namespace TelegramPro\Types;

/**
 * Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
 */
final class EncryptedPassportElementType implements ApiReadType
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
        return new static($type);
    }
}