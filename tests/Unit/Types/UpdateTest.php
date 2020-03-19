<?php namespace Tests\Unit\Types;

use TelegramPro\Types\Update;
use Tests\ExampleWebhooks;
use TelegramPro\Types\MessageEntity;
use PHPUnit\Framework\TestCase;

final class UpdateTest extends TestCase
{
    use ExampleWebhooks;

    function testMessageWithText()
    {
        # Update
        $update = Update::fromApi($this->messageWithText);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testForwardedMessage()
    {
        # Update
        $update = Update::fromApi($this->forwardedMessage);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame(1441645550, $message->forwardDate());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Forward From
        $from = $message->forwardFrom();

        self::assertSame('Forward Lastname', $from->lastName());
        self::assertSame(222222, $from->userId());
        self::assertSame('Forward Firstname', $from->firstName());
    }

    function testForwardedChannelMessage()
    {
        # Update
        $update = Update::fromApi($this->forwardedChannelMessage);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame(1441645550, $message->forwardDate());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Forward From
        self::assertNull($message->forwardFrom());

        # Message - Forward From Chat
        $fromChat = $message->forwardFromChat();

        self::assertSame(-10000000000, $fromChat->chatId());
        self::assertSame('channel', $fromChat->type());
        self::assertSame('Test channel', $fromChat->title());
    }

    function testMessageWithAReply()
    {
        # Update
        $update = Update::fromApi($this->messageWithAReply);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Reply To Message
        $replyToMessage = $message->replyToMessage();

        self::assertNotNull($replyToMessage);
        self::assertSame(1441645000, $replyToMessage->date());
        self::assertSame(1334, $replyToMessage->messageId());
        self::assertSame('Original', $replyToMessage->text());

        # Reply To Message - Chat
        $replyToMessageChat = $replyToMessage->chat();

        self::assertSame('Reply Lastname', $replyToMessageChat->lastName());
        self::assertSame(1111112, $replyToMessageChat->chatId());
        self::assertSame('private', $replyToMessageChat->type());
        self::assertSame('Reply Firstname', $replyToMessageChat->firstName());
        self::assertSame('Testusername', $replyToMessageChat->username());
    }

    function testEditedMessage()
    {
        # Update
        $update = Update::fromApi($this->editedMessage);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->editedMessage();


        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame('Edited text', $message->text());
        self::assertSame(1441646600, $message->editDate());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testMessageWithEntities()
    {
        # Update
        $update = Update::fromApi($this->messageWithEntities);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertSame('Bold and italics', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Entities
        $entities = $message->entities();

        self::assertCount(2, $entities);

        /** @var MessageEntity $one */
        $one = $entities[0];

        self::assertSame('italic', $one->type());
        self::assertSame(9, $one->offset());
        self::assertSame(7, $one->length());

        /** @var MessageEntity $two */
        $two = $entities[1];

        self::assertSame('bold', $two->type());
        self::assertSame(0, $two->offset());
        self::assertSame(4, $two->length());
    }

    function testMessageWithAudio()
    {
        # Update
        $update = Update::fromApi($this->messageWithAudio);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());
        self::assertNull($message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Audio
        $audio = $message->audio();

        self::assertSame('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $audio->fileId());
        self::assertSame(243, $audio->duration());
        self::assertSame('audio/mpeg', $audio->mimeType());
        self::assertSame(3897500, $audio->fileSize());
        self::assertSame('Test music file', $audio->title());
    }

    function testVoiceMessage()
    {
        # Update
        $update = Update::fromApi($this->voiceMessage);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Voice
        $voice = $message->voice();

        self::assertSame('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $voice->fileId());
        self::assertSame(5, $voice->duration());
        self::assertSame('audio/ogg', $voice->mimeType());
        self::assertSame(23000, $voice->fileSize());
    }

    function testMessageWithADocument()
    {
        # Update
        $update = Update::fromApi($this->messageWithADocument);

        self::assertSame(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date());
        self::assertSame(1365, $message->messageId());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        self::assertSame(1111111, $chat->chatId());
        self::assertSame('private', $chat->type());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Document
        $document = $message->document();

        self::assertSame('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $document->fileId());
        self::assertSame('Testfile.pdf', $document->fileName());
        self::assertSame('application/pdf', $document->mimeType());
        self::assertSame(536392, $document->fileSize());
    }

    function testInlineQuery()
    {
        $update = Update::fromApi($this->inlineQuery);

        self::assertSame(10000, $update->updateId());

        # Update - InlineQuery
        $query = $update->inlineQuery();

        self::assertSame('134567890097', $query->id());
        self::assertSame('inline query', $query->query());
        self::assertSame('', $query->offset());

        # InlineQuery - From
        $from = $query->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testChosenInlineQuery()
    {
        $update = Update::fromApi($this->chosenInlineQuery);

        self::assertSame(10000, $update->updateId());

        # Update - ChosenInlineResult
        $inlineResult = $update->chosenInlineResult();

        self::assertSame('12', $inlineResult->resultId());
        self::assertSame('inline query', $inlineResult->query());
        self::assertSame('1234csdbsk4839', $inlineResult->inlineMessageId());

        # InlineQuery - From
        $from = $inlineResult->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testCallbackQuery()
    {
        $update = Update::fromApi($this->callbackQuery);

        self::assertSame(10000, $update->updateId());

        # Update - CallbackQuery
        $callbackQuery = $update->callbackQuery();

        self::assertSame('4382bfdwdsb323b2d9', $callbackQuery->id());
        self::assertSame('Data from button callback', $callbackQuery->data());
        self::assertSame('1234csdbsk4839', $callbackQuery->inlineMessageId());

        # InlineQuery - From
        $from = $callbackQuery->from();

        self::assertSame('Test Lastname', $from->lastName());
        self::assertSame(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }
}