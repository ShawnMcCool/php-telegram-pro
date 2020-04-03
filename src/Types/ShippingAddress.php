<?php namespace TelegramPro\Types;

/**
 * This object represents a shipping address.
 */
final class ShippingAddress implements ApiReadType
{
    private CountryCode $countryCode;
    private string $state;
    private string $city;
    private string $streetLine1;
    private string $streetLine2;
    private string $postalCode;

    public function __construct(
        CountryCode $countryCode,
        string $state,
        string $city,
        string $streetLine1,
        string $streetLine2,
        string $postalCode
    ) {
        $this->countryCode = $countryCode;
        $this->state = $state;
        $this->city = $city;
        $this->streetLine1 = $streetLine1;
        $this->streetLine2 = $streetLine2;
        $this->postalCode = $postalCode;
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($shippingAddress): ?ShippingAddress
    {
        if ( ! $shippingAddress) return null;

        return new static(
            CountryCode::fromApi($shippingAddress->country_code),
            $shippingAddress->state,
            $shippingAddress->city,
            $shippingAddress->street_line_1,
            $shippingAddress->street_line_2,
            $shippingAddress->postal_code
        );
    }

    /**
     * ISO 3166-1 alpha-2 country code
     */
    public function countryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * State, if applicable
     */
    public function state(): string
    {
        return $this->state;
    }

    /**
     * 	City
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * First line for the address
     */
    public function streetLine1(): string
    {
        return $this->streetLine1;
    }

    /**
     * Second line for the address
     */
    public function streetLine2(): string
    {
        return $this->streetLine2;
    }

    /**
     * Address post code
     */
    public function postalCode(): string
    {
        return $this->postalCode;
    }
}