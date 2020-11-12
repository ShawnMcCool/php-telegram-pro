<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\Types\Url;
use TelegramPro\Bot\Methods\SendMessage;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\ParseMode;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\EditMessageReplyMarkup;
use TelegramPro\Bot\Types\ArrayOfInlineKeyboardRows;
use TelegramPro\Bot\Types\ArrayOfInlineKeyboardButtons;
use TelegramPro\Bot\Methods\Keyboards\ReplyKeyboardMarkup;
use TelegramPro\Bot\Methods\Keyboards\ReplyKeyboardRemove;
use TelegramPro\Bot\Methods\Keyboards\InlineKeyboardButton;
use TelegramPro\Bot\Methods\Keyboards\InlineKeyboardMarkup;

class EditMessageReplyMarkupTest extends TelegramTestCase
{
    /** 
     * @doesNotPerformAssertions 
     * @todo this test 
     */
    function testEditChatMessageText()
    {
//        $chatId = $this->config->cyclingChatId();
//        
//        $sendMessageResponse = SendMessage::parameters(
//            $chatId,
//            MessageText::fromString('[EditMessageReplyMarkupTest] send initial message'),
//            ParseMode::none(),
//            true,
//            true,
//            null,
//            new ReplyKeyboardMarkup(
//                ArrayOfInlineKeyboardRows::fromList(
//                    ArrayOfInlineKeyboardButtons::fromList(
//                        new InlineKeyboardButton(
//                            'OLD KEYBOARD'
//                        )
//                    )
//                )
//            )
//        )->send($this->telegram);
//        
//        $response = EditMessageReplyMarkup::parametersForChat(
//            $chatId,
//            $sendMessageResponse->sentMessage()->messageId(),
//            new ReplyKeyboardRemove(true)
//        )->send($this->telegram);
//
//        dd($response);
//        $this->isOk($response);
//
//        self::assertInstanceOf(Message::class, $response->editedMessage());
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
//    function testCanParseError()
//    {
//        $response = EditMessageText::parametersForChat(
//            $this->config->wrongGroupId(),
//            MessageId::fromInt(123),
//            MessageText::fromString('[EditMessageText] testing error')
//        )->send($this->telegram);
//
//        self::assertFalse($response->ok());
//        self::assertInstanceOf(MethodError::class, $response->error());
//        self::assertSame('400', $response->error()->code());
//        self::assertNotEmpty($response->error()->description());
//    }
}
