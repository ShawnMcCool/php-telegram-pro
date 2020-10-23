<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetChatStickerSet;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Figure out how to test this
 */
class SetChatStickerSetTest extends TelegramTestCase
{
//    function testCanSetChatStickerSet()
//    {
//        $response = SetChatStickerSet::parameters(
//            $this->config->supergroupChatId(),
//            'BrokenCats'
//        )->send($this->telegram);
//
//        $this->isOk($response);
//        self::assertTrue($response->chatStickerSetWasSet());
//    }

//    function testCanParseError()
//    {
//        $response = SetChatStickerSet::parameters(
//            $this->config->wrongGroupId()
//        )->send($this->telegram);
//
//        self::assertFalse($response->ok());
//        self::assertInstanceOf(MethodError::class, $response->error());
//        self::assertSame('400', $response->error()->code());
//        self::assertNotEmpty($response->error()->description());
//    }
}