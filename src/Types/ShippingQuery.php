<?php namespace TelegramPro\Types;

final class ShippingQuery
{
    private string $id;
    private User $from;
    private string $invoicePayload;
    private ShippingAddress $shippingAddress;

    public function __construct(
        string $id,
        User $from,
        string $invoicePayload,
        ShippingAddress $shippingAddress
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->invoicePayload = $invoicePayload;
        $this->shippingAddress = $shippingAddress;
    }

    public static function fromApi($shippingQuery): ?ShippingQuery
    {
        if ( ! $shippingQuery) return null;

        return new static(
            $shippingQuery->id,
            User::fromApi($shippingQuery->from),
            $shippingQuery->invoice_payload,
            ShippingAddress::fromApi($shippingQuery->shipping_address)
        );
    }
}