<?php namespace TelegramPro\Types;

final class Invoice
{
    private string $title;
    private string $description;
    private string $startParameter;
    private string $currency;
    private string $totalAmount;

    public function __construct(
        string $title,
        string $description,
        string $startParameter,
        string $currency,
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
            $invoice->currency,
            $invoice->total_amount
        );
    }
}