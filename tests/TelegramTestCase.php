<?php namespace Tests;

use Tests\Terminal\Ansi;
use Tests\Api\BotTestConfig;
use TelegramPro\Api\Telegram;
use PHPUnit\Framework\TestCase;
use TelegramPro\Methods\Method;
use TelegramPro\Api\TelegramApi;

class TelegramTestCase extends TestCase
{
    protected Telegram $telegram;
    protected BotTestConfig $config;
    protected TestMedia $media;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = BotTestConfig::fromConfigFile('.bot-test-config');

        $this->telegram = TelegramApi::botToken(
            $this->config->token()
        );

        $this->media = TestMedia::paths(
            'tests/Media/Images',
            'https://homepages.cae.wisc.edu/~ece533/images/boat.png',
            'tests/Media/Audio/audio.mp3',
            'tests/Media/Audio/audio.m4a',
            'https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3',
            'tests/Media/Documents/the-comedy-of-errors_william-shakespeare.txt'
        );
    }

    protected function call(Method $method)
    {
        $this->telegram->send($method);
    }

    protected function isOk($response)
    {
        $errorMessage = $response->error() 
            ? Ansi::red($response->error()->description())
            : '';
        
        self::assertTrue($response->ok(), $errorMessage);
    }
}