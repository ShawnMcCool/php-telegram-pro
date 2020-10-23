<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\PinChatMessage;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class PinChatMessageTest extends TelegramTestCase
{
    /**
     * @todo add getChat so that this can verify the pinned message status
     */
    function testSetChatPhotoWithFilePath()
    {
        $chatId = $this->config->validGroup();
        
        $messageResponse = SendMessage::parameters(
            $chatId,
            MessageText::fromString('this is a message to be pinned.')
        )->send($this->telegram);
        
        $response = PinChatMessage::parameters(
            $chatId,
            $messageResponse->sentMessage()->messageId()
        )->send($this->telegram);
        
        $this->isOk($response);
        self::assertTrue($response->messageWasPinned());
    }

    function testCanParseError()
    {
        $response = PinChatMessage::parameters(
            $this->config->validGroup(),
            MessageId::fromInt(912837129)
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}