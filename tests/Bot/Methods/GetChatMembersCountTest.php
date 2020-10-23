<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\GetChatMembersCount;

class GetChatMembersCountTest extends TelegramTestCase
{
    function testCanGetChat()
    {
        $response = GetChatMembersCount::parameters(
            $this->config->validGroup()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertSame(2, $response->memberCount());
    }

    function testCanParseError()
    {
        $response = GetChatMembersCount::parameters(
            $this->config->wrongGroupId ()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}