<?php namespace TelegramPro\Types;

/**
 * This object represents a phone contact.
 */
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
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

    /**
     * Contact's phone number
     */
    public function phoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Contact's first name
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     *
     */
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Optional. Contact's last name
     */
    public function userId(): ?UserId
    {
        return $this->userId;
    }

    /**
     * Optional. Additional data about the contact in the form of a vCard
     */
    public function vcard(): ?string
    {
        return $this->vcard;
    }
}