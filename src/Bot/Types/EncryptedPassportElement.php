<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\EncryptedPassportElementType;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 */
final class EncryptedPassportElement implements ApiReadType
{
    private EncryptedPassportElementType $type;
    private ?string $data;
    private ?string $phoneNumber;
    private ?string $email;
    private ArrayOfPassportFiles $files;
    private ?PassportFile $frontSide;
    private ?PassportFile $reverseSide;
    private ?PassportFile $selfie;
    private ArrayOfPassportFiles $translation;
    private string $hash;

    private function __construct(
        EncryptedPassportElementType $type,
        ?string $data,
        ?string $phoneNumber,
        ?string $email,
        ArrayOfPassportFiles $files,
        ?PassportFile $frontSide,
        ?PassportFile $reverseSide,
        ?PassportFile $selfie,
        ArrayOfPassportFiles $translation,
        string $hash
    ) {
        $this->type = $type;
        $this->data = $data;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->files = $files;
        $this->frontSide = $frontSide;
        $this->reverseSide = $reverseSide;
        $this->selfie = $selfie;
        $this->translation = $translation;
        $this->hash = $hash;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($encryptedPassportElement): EncryptedPassportElement
    {
        return new static(
            EncryptedPassportElementType::fromApi($encryptedPassportElement->type),
            $encryptedPassportElement->data,
            $encryptedPassportElement->phone_number,
            $encryptedPassportElement->email,
            ArrayOfPassportFiles::fromApi($encryptedPassportElement->files),
            PassportFile::fromApi($encryptedPassportElement->front_side),
            PassportFile::fromApi($encryptedPassportElement->reverse_side),
            PassportFile::fromApi($encryptedPassportElement->selfie),
            ArrayOfPassportFiles::fromApi($encryptedPassportElement->translation),
            $encryptedPassportElement->hash
        );
    }

    /**
     * 	Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
     */
    public function type(): EncryptedPassportElementType
    {
        return $this->type;
    }

    /**
     * Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function data(): ?string
    {
        return $this->data;
    }

    /**
     * Optional. User's verified phone number, available only for “phone_number” type
     */
    public function phoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Optional. User's verified email address, available only for “email” type
     */
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * Optional. Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function files(): ArrayOfPassportFiles
    {
        return $this->files;
    }

    /**
     * Optional. Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function frontSide(): ?PassportFile
    {
        return $this->frontSide;
    }

    /**
     * Optional. Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function reverseSide(): ?PassportFile
    {
        return $this->reverseSide;
    }

    /**
     * Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function selfie(): ?PassportFile
    {
        return $this->selfie;
    }

    /**
     * Optional. Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function translation(): ArrayOfPassportFiles
    {
        return $this->translation;
    }

    /**
     * Base64-encoded element hash for using in PassportElementErrorUnspecified
     */
    public function hash(): string
    {
        return $this->hash;
    }
}