<?php namespace TelegramPro;

final class Invoice
***REMOVED***
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
    ) ***REMOVED***
        $this->title = $title;
        $this->description = $description;
        $this->startParameter = $startParameter;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
    ***REMOVED***

    public static function fromRequest($invoice): ?Invoice
    ***REMOVED***
        if ( ! $invoice) return null;

        return new static(
            $invoice->title,
            $invoice->description,
            $invoice->start_parameter,
            $invoice->currency,
            $invoice->total_amount
        );
    ***REMOVED***
***REMOVED***