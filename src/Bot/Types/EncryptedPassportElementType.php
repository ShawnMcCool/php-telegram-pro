<?php namespace TelegramPro\Bot\Types;

/**
 * Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”,
 * “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”,
 * “phone_number”, “email”.
 */
final class EncryptedPassportElementType extends \TelegramPro\PrimitiveTypes\StringObject
{
    public function isPersonalDetails(): bool
    {
        return $this->string == "personal_details";
    }

    public function isPassport(): bool
    {
        return $this->string == "passport";
    }

    public function isDriverLicense(): bool
    {
        return $this->string == "driver_license";
    }

    public function isIdentityCard(): bool
    {
        return $this->string == "identity_card";
    }

    public function isInternalPassport(): bool
    {
        return $this->string == "internal_passport";
    }

    public function isAddress(): bool
    {
        return $this->string == "address";
    }

    public function isUtilityBill(): bool
    {
        return $this->string == "utility_bill";
    }

    public function isBankStatement(): bool
    {
        return $this->string == "bank_statement";
    }

    public function isRentalAgreement(): bool
    {
        return $this->string == "rental_agreement";
    }

    public function isPassportRegistration(): bool
    {
        return $this->string == "passport_registration";
    }

    public function isTemporaryRegistration(): bool
    {
        return $this->string == "temporary_registration";
    }

    public function isPhoneNumber(): bool
    {
        return $this->string == "phone_number";
    }

    public function isEmail(): bool
    {
        return $this->string == "email";
    }
}