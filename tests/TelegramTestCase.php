<?php namespace Tests;

use Tests\Api\BotTestConfig;
use PHPUnit\Framework\TestCase;
use TelegramPro\Methods\Method;
use TelegramPro\Http\TelegramApi;

class TelegramTestCase extends TestCase
{
    protected TelegramApi $telegramApi;
    protected BotTestConfig $config;
    protected TestMedia $media;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = BotTestConfig::fromConfigFile('.bot-test-config');

        $this->telegramApi = TelegramApi::botToken(
            $this->config->token()
        );
        
        $this->media = TestMedia::paths(
            'tests/Media/Images'
        );
    }

    protected function call(Method $method)
    {
        $this->telegramApi->send($method);
    }
}