<?php namespace TelegramPro\Types;

final class ShippingAddress
***REMOVED***
    private string $countryCode;
    private string $state;
    private string $city;
    private string $streetLine1;
    private string $streetLine2;
    private string $postalCode;

    public function __construct(
        string $countryCode,
        string $state,
        string $city,
        string $streetLine1,
        string $streetLine2,
        string $postalCode
    ) ***REMOVED***
        $this->countryCode = $countryCode;
        $this->state = $state;
        $this->city = $city;
        $this->streetLine1 = $streetLine1;
        $this->streetLine2 = $streetLine2;
        $this->postalCode = $postalCode;
    ***REMOVED***

    public static function fromApi($shippingAddress): ?ShippingAddress
    ***REMOVED***
        if ( ! $shippingAddress) return null;

        return new static(
            $shippingAddress->country_code,
            $shippingAddress->state,
            $shippingAddress->city,
            $shippingAddress->street_line_1,
            $shippingAddress->street_line_2,
            $shippingAddress->postal_code
        );
    ***REMOVED***
***REMOVED***