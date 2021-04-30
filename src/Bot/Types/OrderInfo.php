<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represents information about an order.
 */
final class OrderInfo implements ApiReadType
{
    private function __construct(
        private ?string $name,
        private ?string $phoneNumber,
        private ?string $email,
        private ?ShippingAddress $shippingAddress
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($orderInfo): ?static
    {
        if ( ! $orderInfo) return null;

        return new static(
            $orderInfo->name,
            $orderInfo->phone_number,
            $orderInfo->email,
            ShippingAddress::fromApi($orderInfo->shipping_address)
        );
    }

    /**
     * Optional. User name
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Optional. User's phone number
     */
    public function phoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Optional. User email
     */
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * Optional. User shipping address
     */
    public function shippingAddress(): ?ShippingAddress
    {
        return $this->shippingAddress;
    }
}