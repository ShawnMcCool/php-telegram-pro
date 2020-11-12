<?php namespace TelegramPro\Bot\Methods\Requests;

use TelegramPro\Api\CurlParameters;

final class JsonRequest implements Request
{
    private string $method;
    private array $parameters = [];

    private function __construct(string $method)
    {
        $this->method = $method;
    }

    public static function forMethod(string $method): self
    {
        return new static($method);
    }

    public function withParameters(array $parameterArray): self
    {
        $this->parameters = $parameterArray;
        return $this;
    }

    public function toCurlParameters(string $botToken): CurlParameters
    {
        $jsonData = json_encode($this->parameters());
        $dataLength = strlen($jsonData);

        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Content-Length: ' . $dataLength,
                ],
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    /**
     * Return JSON encoded object for sending to Telegram as a response to an update.
     * https://core.telegram.org/bots/faq#how-can-i-make-requests-in-response-to-updates
     */
    public function toJson(): string
    {
        return json_encode(
            array_merge(
                [
                    'method' => $this->method,
                ],
                $this->parameters()
            )
        );
    }

    private function parameters(): array
    {
        return array_filter($this->parameters);
    }
}