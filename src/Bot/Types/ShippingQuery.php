<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object contains information about an incoming shipping query.
 */
final class ShippingQuery implements ApiReadType
{
    private function __construct(
        private ShippingQueryId $id,
        private User $from,
        private string $invoicePayload,
        private ShippingAddress $shippingAddress
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($shippingQuery): ?static
    {
        if ( ! $shippingQuery) return null;

        return new static(
            ShippingQueryId::fromApi($shippingQuery->id),
            User::fromApi($shippingQuery->from),
            $shippingQuery->invoice_payload,
            ShippingAddress::fromApi($shippingQuery->shipping_address)
        );
    }

    /**
     * Unique query identifier
     */
    public function id(): ShippingQueryId
    {
        return $this->id;
    }

    /**
     * User who sent the query
     */
    public function from(): User
    {
        return $this->from;
    }

    /**
     * Bot specified invoice payload
     */
    public function invoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * User specified shipping address
     */
    public function shippingAddress(): ShippingAddress
    {
        return $this->shippingAddress;
    }
}