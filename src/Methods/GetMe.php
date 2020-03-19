<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Http\CurlParameters;

final class GetMe implements Method
***REMOVED***
    private function __construct()
    ***REMOVED***
    ***REMOVED***

    function toCurlParameters(string $botToken): CurlParameters
    ***REMOVED***
        return Request::queryString('getMe')
            ->toCurlParameters($botToken);
    ***REMOVED***

    public static function parameters(array $parameters = []): GetMe
    ***REMOVED***
        return new static;
    ***REMOVED***
    
    public function send(TelegramApi $telegramApi): GetMeResponse
    ***REMOVED***
        return GetMeResponse::fromApi(
            $telegramApi->send($this)
        );
    ***REMOVED***
***REMOVED***