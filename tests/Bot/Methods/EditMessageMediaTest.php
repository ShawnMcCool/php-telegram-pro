<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendPhoto;
use TelegramPro\Bot\Types\FileUniqueId;
use TelegramPro\Bot\Methods\Types\MessageId;
use TelegramPro\Bot\Methods\EditMessageMedia;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\Types\MediaCaption;
use TelegramPro\Bot\Methods\FileUploads\FilePath;
use TelegramPro\Bot\Methods\FileUploads\InputPhotoFile;
use TelegramPro\Bot\Methods\FileUploads\InputMediaPhoto;

class EditMessageMediaTest extends TelegramTestCase
{
    function testEditChatMessageMedia()
    {
        $chatId = $this->config->cyclingChatId();

        $sendPhotoResponse = SendPhoto::parameters(
            $chatId,
            InputPhotoFile::fromFilePath(
                FilePath::fromString($this->media->image(0))
            ),
            MediaCaption::fromString('[EditMessageMedia] initial image to be replaced, caption will be removed upon edit')
        )->send($this->telegram);

        $this->isOk($sendPhotoResponse);
        
        /** @var FileUniqueId $fileUniqueId */
        $fileUniqueId = $sendPhotoResponse->sentMessage()->photo()->get(0)->fileUniqueId();

        $response = EditMessageMedia::parametersForChat(
            $chatId,
            $sendPhotoResponse->sentMessage()->messageId(),
            InputMediaPhoto::fromFilePath(
                FilePath::fromString($this->media->image(1))
            )
        )->send($this->telegram);

        $this->isOk($response);

        self::assertNotEquals($fileUniqueId->toString(), $response->editedMessage()->photo()->get(0)->fileUniqueId());
    }
//
//    /**
//     * @todo test this once more inline message functionality is added
//     * @doesNotPerformAssertions
//     */
//    function testCanEditInlineMessageText()
//    {
//
//    }

    function testCanParseError()
    {
        $response = EditMessageMedia::parametersForChat(
            $this->config->wrongGroupId(),
            MessageId::fromInt(123),
            InputMediaPhoto::fromFilePath(
                FilePath::fromString($this->media->image(0))
            )
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
