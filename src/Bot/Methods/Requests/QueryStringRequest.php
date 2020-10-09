<?php namespace TelegramPro\Bot\Methods\Requests;

use TelegramPro\Api\CurlParameters;

final class QueryStringRequest implements Request
{
    private string $method;
    private array $parameters = [];

    private function __construct(string $method)
    {
        $this->method = $method;
    }

    public function withParameters(array $parameterArray): self
    {
        $this->parameters = $parameterArray;
        return $this;
    }

    public function toCurlParameters(string $botToken): CurlParameters
    {
        $parameters = http_build_query($this->parameters());

        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}?{$parameters}",
            [
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => 0,
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

    public static function forMethod(string $method): self
    {
        return new static($method);
    }
}