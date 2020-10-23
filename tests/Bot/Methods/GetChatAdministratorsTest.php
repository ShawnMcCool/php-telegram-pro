<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetChat;
use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\GetChatAdministrators;

class GetChatAdministratorsTest extends TelegramTestCase
{
    function testCanGetChat()
    {
        $response = GetChatAdministrators::parameters(
            $this->config->supergroupChatId()
        )->send($this->telegram);

        $this->isOk($response);
        
        self::assertGreaterThan(0, $response->chatMembers()->count());
        self::assertInstanceOf(User::class, $response->chatMembers()->get(0)->user());
    }

    function testCanParseError()
    {
        $response = GetChatAdministrators::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}