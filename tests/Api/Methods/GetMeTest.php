<?php namespace Tests\Api\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Types\User;
use TelegramPro\Methods\GetMe;

class GetMeTest extends TelegramTestCase
{
    function testCanGetOwnDetails()
    {
        $response = GetMe::parameters()
                         ->send($this->telegramApi);
        
        self::assertTrue($response->ok());
        self::assertInstanceOf(User::class, $response->result());
    }
}
