<?php namespace TelegramPro\Methods;

use TelegramPro\Http\TelegramApi;
use TelegramPro\Http\CurlParameters;

interface Method
***REMOVED***
    static function parameters(array $parameters = []): Method;
    function toCurlParameters(string $botToken): CurlParameters;
    function send(TelegramApi $telegramApi);
***REMOVED***