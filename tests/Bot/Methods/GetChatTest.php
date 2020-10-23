<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetChat;
use TelegramPro\Bot\Methods\Types\MethodError;

class GetChatTest extends TelegramTestCase
{
    function testCanGetChat()
    {
        $chatId = $this->config->cyclingChatId();
        
        $response = GetChat::parameters(
            $chatId
        )->send($this->telegram);

        $this->isOk($response);
        self::assertSame($response->chat()->chatId()->toString(), $chatId->toString());
    }

    function testCanParseError()
    {
        $response = GetChat::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}