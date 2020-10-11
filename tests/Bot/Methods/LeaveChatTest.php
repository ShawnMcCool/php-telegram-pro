<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\LeaveChat;
use TelegramPro\Bot\Methods\Types\MethodError;

class LeaveChatTest extends TelegramTestCase
{
    /**
     * @doesNotPerformAssertions 
     * @todo find a way to test
     */
    function testCanLeaveChat()
    {
//        $response = LeaveChat::parameters(
//            $this->config->chatId()
//        )->send($this->telegram);
//
//        $this->isOk($response);
//        self::assertTrue($response->chatWasLeft());
    }

    function testCanParseError()
    {
        $response = LeaveChat::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}