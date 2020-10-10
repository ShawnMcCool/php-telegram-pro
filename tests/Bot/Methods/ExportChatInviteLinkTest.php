<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\ExportChatInviteLink;

class ExportChatInviteLinkTest extends TelegramTestCase
{
    function testExportChatInviteLink()
    {
        $response = ExportChatInviteLink::parameters(
            $this->config->chatId(),
        )->send($this->telegram);

        $this->isOk($response);
        self::assertStringStartsWith('https://t.me/joinchat/', $response->newInviteLink());
    }

    function testCanParseError()
    {
        $response = ExportChatInviteLink::parameters(
            $this->config->wrongGroupId(),
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
