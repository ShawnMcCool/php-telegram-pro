<?php namespace Tests\Api\Methods;

use PHPUnit\Framework\TestCase;
use TelegramPro\Methods\Method;
use TelegramPro\Http\TelegramApi;

class MethodTestCase extends TestCase
***REMOVED***
    protected TelegramApi $telegramApi;

    protected function setUp(): void
    ***REMOVED***
        parent::setUp();
        $this->telegramApi = TelegramApi::botToken(
            trim(file_get_contents('.token'))
        );
    ***REMOVED***
    
    protected function call(Method $method) ***REMOVED***
        $this->telegramApi->send($method);
    ***REMOVED***
***REMOVED***