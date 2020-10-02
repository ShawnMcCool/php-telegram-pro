<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetMe;
use TelegramPro\Bot\Methods\Types\User;

class GetMeTest extends TelegramTestCase
{
    function testCanGetOwnDetails()
    {
        $response = GetMe::parameters()
                         ->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(User::class, $response->botInformation());
    }
}
