<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\Currency;

/**
 * This object contains basic information about an invoice.
 */
final class Invoice implements ApiReadType
{
    private function __construct(
        private string $title,
        private string $description,
        private string $startParameter,
        private Currency $currency,
        private int $totalAmount
    ) {
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($invoice): ?static
    {
        if ( ! $invoice) return null;

        return new static(
            $invoice->title,
            $invoice->description,
            $invoice->start_parameter,
            Currency::fromApi($invoice->currency),
            $invoice->total_amount
        );
    }

    /**
     * Product name
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * Product description
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice
     */
    public function startParameter(): string
    {
        return $this->startParameter;
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
}