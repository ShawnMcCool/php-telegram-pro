<?php namespace TelegramPro\Api;

final class CurlParameters
{

    public function __construct(
        private string $url,
        private array $optionArray = []
    ) {
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