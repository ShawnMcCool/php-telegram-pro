<?php namespace TelegramPro\Http;

final class CurlParameters
{
    private string $url;
    private array $optionArray;

    public function __construct(string $url, array $optionArray = [])
    {
        $this->url = $url;
        $this->optionArray = $optionArray;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function optionArray(): array
    {
        return $this->optionArray;
    }
}