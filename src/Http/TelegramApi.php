<?php namespace TelegramPro\Http;

use TelegramPro\Methods\Method;

final class TelegramApi
***REMOVED***
    private string $botToken;

    private function __construct(string $botToken)
    ***REMOVED***
        $this->botToken = $botToken;
    ***REMOVED***

    public function send(Method $method)
    ***REMOVED***
        $parameters = $method->toCurlParameters($this->botToken);
        
        $curl = curl_init($parameters->url());
        
        curl_setopt_array($curl, $parameters->optionArray());
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    ***REMOVED***

    public static function botToken(string $botToken): TelegramApi
    ***REMOVED***
        return new static($botToken);
    ***REMOVED***
***REMOVED***