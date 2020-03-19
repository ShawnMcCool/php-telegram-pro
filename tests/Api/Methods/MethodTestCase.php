<?php namespace Tests\Api\Methods;

use Tests\Api\BotTestConfig;
use PHPUnit\Framework\TestCase;
use TelegramPro\Methods\Method;
use TelegramPro\Http\TelegramApi;

class MethodTestCase extends TestCase
{
    protected TelegramApi $telegramApi;
    protected BotTestConfig $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = BotTestConfig::fromConfigFile('.bot-test-config');

        $this->telegramApi = TelegramApi::botToken(
            $this->config->token()
        );
    }

    protected function call(Method $method)
    {
        $this->telegramApi->send($method);
    }
}