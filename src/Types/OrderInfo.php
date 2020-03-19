<?php namespace TelegramPro\Types;

final class OrderInfo
{
    private ?string $name;
    private ?string $phoneNumber;
    private ?string $email;
    private ?ShippingAddress $shippingAddress;

    public function __construct(
        ?string $name,
        ?string $phoneNumber,
        ?string $email,
        ?ShippingAddress $shippingAddress
    ) {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->shippingAddress = $shippingAddress;
    }

    public static function fromApi($orderInfo): ?OrderInfo
    {
        if ( ! $orderInfo) return null;

        return new static(
            $orderInfo->name,
            $orderInfo->phone_number,
            $orderInfo->email,
            ShippingAddress::fromApi($orderInfo->shipping_address)
        );
    }
}