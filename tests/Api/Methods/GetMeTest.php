<?php namespace Tests\Api\Methods;

use TelegramPro\Types\User;
use TelegramPro\Methods\GetMe;

class GetMeTest extends MethodTestCase
{
    function testCanGetOwnDetails()
    {
        $response = GetMe::parameters()
                         ->send($this->telegramApi);
        
        self::assertTrue($response->ok());
        self::assertInstanceOf(User::class, $response->result());
    }
}
