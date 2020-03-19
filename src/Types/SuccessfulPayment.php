<?php namespace TelegramPro\Types;

final class SuccessfulPayment
{
    private string $currency;
    private string $totalAmount;
    private string $invoicePayload;
    private ?string $shippingOptionId;
    private ?OrderInfo $orderInfo;
    private string $telegramPaymentChargeId;
    private string $providerPaymentChargeId;

    public function __construct(
        string $currency,
        string $totalAmount,
        string $invoicePayload,
        ?string $shippingOptionId,
        ?OrderInfo $orderInfo,
        string $telegramPaymentChargeId,
        string $providerPaymentChargeId
    ) {
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->invoicePayload = $invoicePayload;
        $this->shippingOptionId = $shippingOptionId;
        $this->orderInfo = $orderInfo;
        $this->telegramPaymentChargeId = $telegramPaymentChargeId;
        $this->providerPaymentChargeId = $providerPaymentChargeId;
    }

    public static function fromApi($successfulPayment): ?SuccessfulPayment
    {
        if ( ! $successfulPayment) return null;

        return new static(
            $successfulPayment->currency,
            $successfulPayment->total_amount,
            $successfulPayment->invoice_payment,
            $successfulPayment->shipping_option_id,
            OrderInfo::fromApi($successfulPayment->order_info),
            $successfulPayment->telegram_payment_charge_id,
            $successfulPayment->provider_payment_charge_id,
        );
    }
}