<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\GetChatMember;
use TelegramPro\Bot\Methods\Types\ChatMember;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\GetChatAdministrators;

class GetChatMemberTest extends TelegramTestCase
{
    function testCanGetChatMember()
    {
        $chatAdminsResponse = GetChatAdministrators::parameters(
            $this->config->chatId()
        )->send($this->telegram);
        
        $nonBotUser = null;
        
        /** @var ChatMember $chatMember */
        foreach ($chatAdminsResponse->chatMembers() as $chatMember) {
            if ($chatMember->user()->isBot()) continue;
            $nonBotUser = $chatMember->user();
            break;
        }
        
        self::assertNotNull($nonBotUser);
        
        $response = GetChatMember::parameters(
            $this->config->chatId(),
            $nonBotUser->userId()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($nonBotUser->userId()->equals($response->chatMember()->user()->userId()));
    }

    function testCanParseError()
    {
        $response = GetChatMember::parameters(
            $this->config->wrongGroupId(),
            UserId::fromInt(1)
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}