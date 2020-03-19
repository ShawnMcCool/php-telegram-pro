<?php namespace TelegramPro\Http;

use TelegramPro\Methods\Method;

final class TelegramApi
{
    private string $botToken;

    private function __construct(string $botToken)
    {
        $this->botToken = $botToken;
    }

    public function send(Method $method)
    {
        $parameters = $method->toCurlParameters($this->botToken);
        
        $curl = curl_init($parameters->url());
        
        curl_setopt_array($curl, $parameters->optionArray());
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }

    public static function botToken(string $botToken): TelegramApi
    {
        return new static($botToken);
    }
}