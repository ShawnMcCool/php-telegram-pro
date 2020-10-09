<?php namespace Tests;

use Tests\Terminal\Ansi;
use Tests\Bot\BotTestConfig;
use TelegramPro\Api\Telegram;
use PHPUnit\Framework\TestCase;
use TelegramPro\Bot\Methods\Method;
use TelegramPro\Api\TelegramHttpRequest;
use TelegramPro\Bot\RateLimiting\BlockingRateLimiter;

class TelegramTestCase extends TestCase
{
    private static ?Telegram $telegramInstance = null;
    
    protected Telegram $telegram;
    protected BotTestConfig $config;
    protected TestMedia $media;

    public static function telegramInstance(): ?Telegram
    {
        return static::$telegramInstance;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = BotTestConfig::fromConfigFile('/vagrant/.bot-test-config');

        $this->media = TestMedia::paths(
            '/vagrant/tests/Media/Images',
            'https://homepages.cae.wisc.edu/~ece533/images/boat.png',
            '/vagrant/tests/Media/Audio/audio.mp3',
            '/vagrant/tests/Media/Audio/audio.m4a',
            'https://file-examples.com/wp-content/uploads/2017/11/file_example_MP3_700KB.mp3',
            '/vagrant/tests/Media/Documents/the-comedy-of-errors_william-shakespeare.txt',
            '/vagrant/tests/Media/Videos/big-buck-bunny-trailer.m4v',
            'https://www.sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4',
            '/vagrant/tests/Media/Animations/spinning-woman.gif',
            'https://www.sample-videos.com/gif/3.gif',
            '/vagrant/tests/Media/Voice/hurdy-sample.ogg',
            'https://upload.wikimedia.org/wikipedia/commons/a/a3/HurdySample.ogg',
            '/vagrant/tests/Media/VideoNotes/golden-ratio-240px.mp4'
        );
        
        if ( ! isset(static::$telegramInstance)) {
            static::$telegramInstance = new BlockingRateLimiter(
                TelegramHttpRequest::botToken(
                    $this->config->token()
                )
            );
        }
        
        $this->telegram = static::telegramInstance();
    }

    protected function send(Method $method)
    {
        $method->send(
            $this->telegram
        );
    }

    protected function isOk($response)
    {
        $errorMessage = $response->error()
            ? Ansi::red($response->error()->description())
            : '';

        self::assertTrue($response->ok(), $errorMessage);
    }

    protected function sameValue(string $one, string $two)
    {
        self::assertSame($one, $two);
    }
}