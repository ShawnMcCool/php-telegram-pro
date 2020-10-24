<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendPhoto;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\EditMessageCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;

class EditMessageCaptionTest extends TelegramTestCase
{
    function testEditChatMessageCaption()
    {
        $chatId = $this->config->cyclingChatId();

        $sendPhotoResponse = SendPhoto::parameters(
            $chatId,
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image())
            ),
            MediaCaption::fromString('[EditMessageCaption] initial caption message')
        )->send($this->telegram);

        $this->isOk($sendPhotoResponse);

        $response = EditMessageCaption::parametersForChat(
            $chatId,
            $sendPhotoResponse->sentMessage()->messageId(),
            MediaCaption::fromString('[EditMessageCaption] message was replaced successfully')
        )->send($this->telegram);

        $this->isOk($response);

        self::assertSame('[EditMessageCaption] message was replaced successfully', $response->editedMessage()->caption());
    }

    /**
     * @todo test this once more inline message functionality is added
     * @doesNotPerformAssertions
     */
    function testCanEditInlineMessageText()
    {

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
        $response = EditMessageCaption::parametersForChat(
            $this->config->cyclingChatId(),
            MessageId::fromInt(123),
            MediaCaption::fromString('[EditMessageCaption] testing error')
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
