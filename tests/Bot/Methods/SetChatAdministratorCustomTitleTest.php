<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetMe;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\SetChatAdministratorCustomTitle;
use TelegramPro\Bot\Methods\Types\ChatAdministratorCustomTitle;

class SetChatAdministratorCustomTitleTest extends TelegramTestCase
{
    /**
     * @doesNotPerformAssertions
     * @todo this can only be applied to cert types of channels
     * set up those channels for testing
     */

    function testSetChatAdministratorCustomTitle()
    {
//        $getMeResponse = GetMe::parameters()->send($this->telegram);
//        
//        $response = SetChatAdministratorCustomTitle::parameters(
//            $this->config->chatId(),
//            $getMeResponse->botInformation()->userId(),
//            ChatAdministratorCustomTitle::fromString('custom title 123')
//        )->send($this->telegram);
//        
//        $this->isOk($response);
//        self::assertInstanceOf(Message::class, $response->customTitleWasSet());
    }

    function testCanParseError()
    {
        $getMeResponse = GetMe::parameters()->send($this->telegram);
        
        $response = SetChatAdministratorCustomTitle::parameters(
            $this->config->cyclingChatId(),
            $getMeResponse->botInformation()->userId(),
            ChatAdministratorCustomTitle::fromString('custom title 123')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
