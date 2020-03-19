<?php namespace TelegramPro\Types;

final class PreCheckoutQuery
{
    private string $id;
    private User $from;
    private string $currency;
    private string $totalAmount;
    private string $invoicePayload;
    private ?string $shippingOptionId;
    private ?OrderInfo $orderInfo;

    public function __construct(
        string $id,
        User $from,
        string $currency,
        string $totalAmount,
        string $invoicePayload,
        ?string $shippingOptionId,
        ?OrderInfo $orderInfo
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
        $this->shippingOptionId = $shippingOptionId;
        $this->orderInfo = $orderInfo;
    }

    public static function fromApi($preCheckoutQuery): ?PreCheckoutQuery
    {
        if ( ! $preCheckoutQuery) return null;

        return new static(
            $preCheckoutQuery->id,
            User::fromApi($preCheckoutQuery->from),
            $preCheckoutQuery->currency,
            $preCheckoutQuery->total_amount,
            $preCheckoutQuery->invoice_payload,
            $preCheckoutQuery->shipping_option_id,
            OrderInfo::fromApi($preCheckoutQuery->order_info)
        );
    }
}