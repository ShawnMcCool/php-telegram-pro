<?php namespace TelegramPro\Types;

final class Contact
{
    private string $phoneNumber;
    private string $firstName;
    private ?string $lastName;
    private ?int $userId;
    private ?string $vcard;

    public function __construct(
        string $phoneNumber,
        string $firstName,
        ?string $lastName,
        ?int $userId,
        ?string $vcard
    ) {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userId = $userId;
        $this->vcard = $vcard;
    }

    public static function fromApi($contact): ?Contact
    {
        if ( ! $contact) return null;

        return new static(
            $contact->phone_number,
            $contact->first_name,
            $contact->last_name,
            $contact->user_id,
            $contact->vcard
        );
    }
}