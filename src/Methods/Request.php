<?php namespace TelegramPro\Methods;

use TelegramPro\Http\CurlParameters;

final class Request
***REMOVED***
    private string $method;
    private string $requestType;
    private array $parameterArray = [];

    private function __construct(
        string $method,
        string $requestType
    ) ***REMOVED***
        $this->method = $method;
        $this->requestType = $requestType;
    ***REMOVED***

    public function withParameters(array $parameterArray): Request
    ***REMOVED***
        $this->parameterArray = $parameterArray;
        return $this;
    ***REMOVED***

    public function toCurlParameters(string $botToken): CurlParameters
    ***REMOVED***
        return new CurlParameters(
            "https://api.telegram.org/bot***REMOVED***$botToken***REMOVED***/***REMOVED***$this->method***REMOVED***",
            [
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => ($this->parameterArray()),
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    ***REMOVED***

    public function parameterArray(): array
    ***REMOVED***
        $validParameters = [];

        foreach ($this->parameterArray as $key => $value) ***REMOVED***
            if ( ! is_null($value)) ***REMOVED***
                $validParameters[$key] = $value;
            ***REMOVED***
        ***REMOVED***

        return $validParameters;
    ***REMOVED***

    public static function queryString(string $method): Request
    ***REMOVED***
        return new static($method, 'query-string');
    ***REMOVED***

    public static function xWwwFormUrlencoded(string $method): Request
    ***REMOVED***
        return new static($method, 'application/x-www-form-urlencoded');
    ***REMOVED***

    public static function multipartFormData(string $method): Request
    ***REMOVED***
        return new static($method, 'multipart/form-data');
    ***REMOVED***

    public static function json(string $method): Request
    ***REMOVED***
        return new static($method, 'application/json');
    ***REMOVED***
***REMOVED***