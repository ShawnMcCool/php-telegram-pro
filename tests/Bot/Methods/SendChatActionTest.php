<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendChatAction;
use TelegramPro\Bot\Methods\Types\ActionType;
use TelegramPro\Bot\Methods\Types\MethodError;

class SendChatActionTest extends TelegramTestCase
{
    function testSendChatAction()
    {
        $response = SendChatAction::parameters(
            $this->config->chatId(),
            ActionType::typing()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->actionWasSent());
    }

    function testCanParseError()
    {
        $response = SendChatAction::parameters(
            $this->config->wrongGroupId(),
            ActionType::typing()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
