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
            'tests/Media/Images',
            'https://homepages.cae.wisc.edu/~ece533/images/boat.png',
            'tests/Media/Audio/audio.mp3',
            'tests/Media/Audio/audio.m4a',
            'https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3'
        );
    }

    protected function call(Method $method)
    {
        $this->telegramApi->send($method);
    }
}