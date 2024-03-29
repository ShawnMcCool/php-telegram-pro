<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object contains information about an incoming pre-checkout query.
 */
final class PreCheckoutQuery implements ApiReadType
{
    private function __construct(
        private PreCheckoutQueryId $id,
        private User $from,
        private Currency $currency,
        private int $totalAmount,
        private string $invoicePayload,
        private ?ShippingOptionId $shippingOptionId,
        private ?OrderInfo $orderInfo
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($preCheckoutQuery): ?static
    {
        if ( ! $preCheckoutQuery) return null;

        return new static(
            PreCheckoutQueryId::fromApi($preCheckoutQuery->id),
            User::fromApi($preCheckoutQuery->from),
            Currency::fromApi($preCheckoutQuery->currency),
            $preCheckoutQuery->total_amount,
            $preCheckoutQuery->invoice_payload,
            ShippingOptionId::fromApi($preCheckoutQuery->shipping_option_id ?? null),
            OrderInfo::fromApi($preCheckoutQuery->order_info)
        );
    }

    /**
     * Unique query identifier
     */
    public function id(): PreCheckoutQueryId
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
}