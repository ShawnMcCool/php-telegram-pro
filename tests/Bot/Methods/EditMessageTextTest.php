<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\EditMessageText;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class EditMessageTextTest extends TelegramTestCase
{
    function testEditChatMessageText()
    {
        $chatId = $this->config->cyclingChatId();
        
        $sendMessageResponse = SendMessage::parameters(
            $chatId,
            MessageText::fromString('[EditMessageText] send initial message')
        )->send($this->telegram);
                
        $response = EditMessageText::parametersForChat(
            $chatId,
            $sendMessageResponse->sentMessage()->messageId(),
            MessageText::fromString('[EditMessageText] message text was updated')
        )->send($this->telegram);

        $this->isOk($response);

        self::assertInstanceOf(Message::class, $response->editedMessage());
    }

    /**
     * @todo test this once more inline message functionality is added
     * @doesNotPerformAssertions 
     */
    function testCanEditInlineMessageText() {
        
    }
    
//    function testSendMarkdownMessage()
//    {
//        $response = SendMessage::parameters(
//            $this->config->cyclingChatId(),
//            MessageText::fromString('[SendMessage] send *markdown parsed* message')
//        )->send($this->telegram);
//
//        $this->isOk($response);
//        self::assertInstanceOf(Message::class, $response->sentMessage());
//    }
//
    function testCanParseError()
    {
        $response = EditMessageText::parametersForChat(
            $this->config->wrongGroupId(),
            MessageId::fromInt(123),
            MessageText::fromString('[EditMessageText] testing error')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
