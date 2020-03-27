<?php namespace TelegramPro\Types;

final class Contact
{
    private string $phoneNumber;
    private string $firstName;
    private ?string $lastName;
    private ?UserId $userId;
    private ?string $vcard;

    public function __construct(
        string $phoneNumber,
        string $firstName,
        ?string $lastName,
        ?UserId $userId,
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
            UserId::fromInt($contact->user_id),
            $contact->vcard
        );
    }

    public function phoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }

    public function userId(): ?UserId
    {
        return $this->userId;
    }

    public function vcard(): ?string
    {
        return $this->vcard;
    }
}