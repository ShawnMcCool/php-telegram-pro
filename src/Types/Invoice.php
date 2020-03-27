<?php namespace TelegramPro\Types;

final class Invoice
{
    private string $title;
    private string $description;
    private string $startParameter;
    private Currency $currency;
    private string $totalAmount;

    public function __construct(
        string $title,
        string $description,
        string $startParameter,
        Currency $currency,
        string $totalAmount
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->startParameter = $startParameter;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
    }

    public static function fromApi($invoice): ?Invoice
    {
        if ( ! $invoice) return null;

        return new static(
            $invoice->title,
            $invoice->description,
            $invoice->start_parameter,
            Currency::fromString($invoice->currency),
            $invoice->total_amount
        );
    }
}