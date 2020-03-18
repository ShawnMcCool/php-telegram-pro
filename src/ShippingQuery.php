<?php namespace TelegramPro;

final class ShippingQuery
***REMOVED***
    private string $id;
    private User $from;
    private string $invoicePayload;
    private ShippingAddress $shippingAddress;

    public function __construct(
        string $id,
        User $from,
        string $invoicePayload,
        ShippingAddress $shippingAddress
    ) ***REMOVED***
        $this->id = $id;
        $this->from = $from;
        $this->invoicePayload = $invoicePayload;
        $this->shippingAddress = $shippingAddress;
    ***REMOVED***

    public static function fromRequest($shippingQuery): ?ShippingQuery
    ***REMOVED***
        if ( ! $shippingQuery) return null;

        return static(
            $shippingQuery->id,
            User::fromRequest($shippingQuery->from),
            $shippingQuery->invoice_payload,
            ShippingAddress::fromRequest($shippingQuery->shipping_address)
        );
    ***REMOVED***
***REMOVED***