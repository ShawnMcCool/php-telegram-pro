<?php namespace TelegramPro\Types;

final class EncryptedPassportElement
{
    private string $type;
    private ?string $data;
    private ?string $phoneNumber;
    private ?string $email;
    private ArrayOfPassportFiles $files;
    private ?PassportFile $frontSide;
    private ?PassportFile $reverseSide;
    private ?PassportFile $selfie;
    private ArrayOfPassportFiles $translation;
    private string $hash;

    public function __construct(
        string $type, // finite
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

    public static function fromApi($encryptedPassportElement): EncryptedPassportElement
    {
        return new static(
            $encryptedPassportElement->type,
            $encryptedPassportElement->data,
            $encryptedPassportElement->phone_number,
            $encryptedPassportElement->email,
            PassportFile::arrayFromApi($encryptedPassportElement->files),
            PassportFile::fromApi($encryptedPassportElement->front_side),
            PassportFile::fromApi($encryptedPassportElement->reverse_side),
            PassportFile::fromApi($encryptedPassportElement->selfie),
            PassportFile::arrayFromApi($encryptedPassportElement->translation),
            $encryptedPassportElement->hash
        );
    }
}