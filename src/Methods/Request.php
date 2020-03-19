<?php namespace TelegramPro\Methods;

use TelegramPro\Http\CurlParameters;

final class Request
{
    private string $method;
    private string $requestType;
    private array $parameterArray = [];

    private function __construct(
        string $method,
        string $requestType
    ) {
        $this->method = $method;
        $this->requestType = $requestType;
    }

    public function withParameters(array $parameterArray): Request
    {
        $this->parameterArray = $parameterArray;
        return $this;
    }

    public function toCurlParameters(string $botToken): CurlParameters
    {
        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => ($this->parameterArray()),
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    public function parameterArray(): array
    {
        $validParameters = [];

        foreach ($this->parameterArray as $key => $value) {
            if ( ! is_null($value)) {
                $validParameters[$key] = $value;
            }
        }

        return $validParameters;
    }

    public static function queryString(string $method): Request
    {
        return new static($method, 'query-string');
    }

    public static function xWwwFormUrlencoded(string $method): Request
    {
        return new static($method, 'application/x-www-form-urlencoded');
    }

    public static function multipartFormData(string $method): Request
    {
        return new static($method, 'multipart/form-data');
    }

    public static function json(string $method): Request
    {
        return new static($method, 'application/json');
    }
}