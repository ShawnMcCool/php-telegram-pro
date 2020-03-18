<?php namespace TelegramPro;

final class OrderInfo
***REMOVED***
    private ?string $name;
    private ?string $phoneNumber;
    private ?string $email;
    private ?ShippingAddress $shippingAddress;

    public function __construct(
        ?string $name,
        ?string $phoneNumber,
        ?string $email,
        ?ShippingAddress $shippingAddress
    ) ***REMOVED***
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->shippingAddress = $shippingAddress;
    ***REMOVED***

    public static function fromRequest($orderInfo): ?OrderInfo
    ***REMOVED***
        if ( ! $orderInfo) return null;

        return new static(
            $orderInfo->name,
            $orderInfo->phone_number,
            $orderInfo->email,
            ShippingAddress::fromRequest($orderInfo->shipping_address)
        );
    ***REMOVED***
***REMOVED***