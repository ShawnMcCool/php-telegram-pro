<?php namespace TelegramPro\Types;

/**
 * This object contains information about an incoming shipping query.
 */
final class ShippingQuery
{
    private ShippingQueryId $id;
    private User $from;
    private string $invoicePayload;
    private ShippingAddress $shippingAddress;

    public function __construct(
        ShippingQueryId $id,
        User $from,
        string $invoicePayload,
        ShippingAddress $shippingAddress
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->invoicePayload = $invoicePayload;
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * Construct with data received from the Telegram bot api.
     */
    public static function fromApi($shippingQuery): ?ShippingQuery
    {
        if ( ! $shippingQuery) return null;

        return new static(
            ShippingQueryId::fromString($shippingQuery->id),
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