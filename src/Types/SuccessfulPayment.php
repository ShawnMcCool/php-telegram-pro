<?php namespace TelegramPro\Types;

/**
 * This object contains basic information about a successful payment.
 */
final class SuccessfulPayment implements ApiReadType
{
    private Currency $currency;
    private int $totalAmount;
    private string $invoicePayload;
    private ?ShippingOptionId $shippingOptionId;
    private ?OrderInfo $orderInfo;
    private string $telegramPaymentChargeId;
    private string $providerPaymentChargeId;

    public function __construct(
        Currency $currency,
        int $totalAmount,
        string $invoicePayload,
        ?ShippingOptionId $shippingOptionId,
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($successfulPayment): ?SuccessfulPayment
    {
        if ( ! $successfulPayment) return null;

        return new static(
            Currency::fromApi($successfulPayment->currency),
            $successfulPayment->total_amount,
            $successfulPayment->invoice_payment,
            ShippingOptionId::fromApi($successfulPayment->shipping_option_id),
            OrderInfo::fromApi($successfulPayment->order_info),
            $successfulPayment->telegram_payment_charge_id,
            $successfulPayment->provider_payment_charge_id,
        );
    }

    /**
     * Three-letter ISO 4217 currency code
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public function totalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * Bot specified invoice payload
     */
    public function invoicePayload(): string
    {
        return $this->invoicePayload;
    }

    /**
     * Optional. Identifier of the shipping option chosen by the user
     */
    public function shippingOptionId(): ?ShippingOptionId
    {
        return $this->shippingOptionId;
    }

    /**
     * Optional. Order info provided by the user
     */
    public function orderInfo(): ?OrderInfo
    {
        return $this->orderInfo;
    }

    /**
     * Telegram payment identifier
     */
    public function telegramPaymentChargeId(): string
    {
        return $this->telegramPaymentChargeId;
    }

    /**
     * Provider payment identifier
     */
    public function providerPaymentChargeId(): string
    {
        return $this->providerPaymentChargeId;
    }
}