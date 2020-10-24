<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\DeleteChatStickerSet;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Figure out how to test this
 */
class DeleteChatStickerSetTest extends TelegramTestCase
{
//    function testCanDeleteChatStickerSet()
//    {
//        $response = DeleteChatStickerSet::parameters(
//            $this->config->validGroup()
//        )->send($this->telegram);
//
//        $this->isOk($response);
//        self::assertTrue($response->chatStickerSetWasSet());
//    }

    function testCanParseError()
    {
        $response = DeleteChatStickerSet::parameters(
            $this->config->wrongGroupId()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}