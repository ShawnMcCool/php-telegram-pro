<?php namespace Tests\Unit\Types;

use Tests\ExampleWebhooks;
use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\Update;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Types\UpdateId;
use TelegramPro\Bot\Types\MessageEntity;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Types\ChatType;
use TelegramPro\Bot\Methods\Types\MessageId;

final class UpdateTest extends TelegramTestCase
{
    use ExampleWebhooks;

    function testMessageWithText()
    {
        # Update
        $update = Update::fromApi(json_decode($this->messageWithText));

        $this->sameValue(UpdateId::fromInt(10000), $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(MessageId::fromApi('1365'), $message->messageId()->toInteger());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(ChatId::fromInt(1111111), $chat->chatId());
        $this->sameValue(ChatType::private()->toApi(), $chat->type()->toApi());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(UserId::fromInt(1111111), $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testForwardedMessage()
    {
        # Update
        $update = Update::fromApi(json_decode($this->forwardedMessage));

        $this->sameValue(UpdateId::fromInt(10000), $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(MessageId::fromApi('1365'), $message->messageId()->toInteger());
        self::assertSame(1441645550, $message->forwardDate()->toUnixTimestamp());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(ChatId::fromInt(1111111), $chat->chatId());
        $this->sameValue(ChatType::private()->toApi(), $chat->type()->toApi());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(UserId::fromInt(1111111), $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Forward From
        $from = $message->forwardFrom();

        self::assertSame('Forward Lastname', $from->lastName());
        $this->sameValue(UserId::fromInt(222222), $from->userId());
        self::assertSame('Forward Firstname', $from->firstName());
    }

    function testForwardedChannelMessage()
    {
        # Update
        $update = Update::fromApi(json_decode($this->forwardedChannelMessage));

        $this->sameValue(UpdateId::fromInt(10000), $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(MessageId::fromApi('1365'), $message->messageId()->toInteger());
        self::assertSame(1441645550, $message->forwardDate()->toUnixTimestamp());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(ChatId::fromInt(1111111), $chat->chatId());
        $this->sameValue(ChatType::private()->toApi(), $chat->type()->toApi());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(ChatId::fromInt(1111111), $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Forward From
        self::assertNull($message->forwardFrom());

        # Message - Forward From Chat
        $fromChat = $message->forwardFromChat();

        $this->sameValue(ChatId::fromInt(-10000000000), $fromChat->chatId());
        $this->sameValue(ChatType::channel()->toApi(), $fromChat->type()->toApi());
        self::assertSame('Test channel', $fromChat->title());
    }

    function testMessageWithAReply()
    {
        # Update
        $update = Update::fromApi(json_decode($this->messageWithAReply));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());
        self::assertSame('/start', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Reply To Message
        $replyToMessage = $message->replyToMessage();

        self::assertNotNull($replyToMessage);
        self::assertSame(1441645000, $replyToMessage->date()->toUnixTimestamp());
        $this->sameValue(1334, $replyToMessage->messageId()->toInteger());
        self::assertSame('Original', $replyToMessage->text());

        # Reply To Message - Chat
        $replyToMessageChat = $replyToMessage->chat();

        self::assertSame('Reply Lastname', $replyToMessageChat->lastName());
        $this->sameValue(1111112, $replyToMessageChat->chatId());
        $this->sameValue('private', $replyToMessageChat->type()->toString());
        self::assertSame('Reply Firstname', $replyToMessageChat->firstName());
        self::assertSame('Testusername', $replyToMessageChat->username());
    }

    function testEditedMessage()
    {
        # Update
        $update = Update::fromApi(json_decode($this->editedMessage));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->editedMessage();


        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());
        self::assertSame('Edited text', $message->text());
        self::assertSame(1441646600, $message->editDate()->toUnixTimestamp());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testMessageWithEntities()
    {
        # Update
        $update = Update::fromApi(json_decode($this->messageWithEntities));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());
        self::assertSame('Bold and italics', $message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Entities
        $entities = $message->entities();

        self::assertCount(2, $entities);

        /** @var MessageEntity $one */
        $one = $entities[0];

        $this->sameValue('italic', $one->type()->toString());
        self::assertSame(9, $one->offset());
        self::assertSame(7, $one->length());

        /** @var MessageEntity $two */
        $two = $entities[1];

        $this->sameValue('bold', $two->type()->toString());
        self::assertSame(0, $two->offset());
        self::assertSame(4, $two->length());
    }

    function testMessageWithAudio()
    {
        # Update
        $update = Update::fromApi(json_decode($this->messageWithAudio));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());
        self::assertNull($message->text());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Audio
        $audio = $message->audio();

        $this->sameValue('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $audio->fileId()->toString());
        self::assertSame(243, $audio->duration());
        self::assertSame('audio/mpeg', $audio->mimeType());
        self::assertSame(3897500, $audio->fileSize());
        self::assertSame('Test music file', $audio->title());
    }

    function testVoiceMessage()
    {
        # Update
        $update = Update::fromApi(json_decode($this->voiceMessage));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Voice
        $voice = $message->voice();

        $this->sameValue('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $voice->fileId()->toString());
        self::assertSame(5, $voice->duration());
        self::assertSame('audio/ogg', $voice->mimeType());
        self::assertSame(23000, $voice->fileSize());
    }

    function testMessageWithADocument()
    {
        # Update
        $update = Update::fromApi(json_decode($this->messageWithADocument));

        $this->sameValue(10000, $update->updateId());

        # Update - Message
        $message = $update->message();

        self::assertNotNull($message);
        self::assertSame(1441645532, $message->date()->toUnixTimestamp());
        $this->sameValue(1365, $message->messageId()->toInteger());

        # Message - Chat
        $chat = $message->chat();

        self::assertSame('Test Lastname', $chat->lastName());
        $this->sameValue(1111111, $chat->chatId());
        $this->sameValue('private', $chat->type()->toString());
        self::assertSame('Test Firstname', $chat->firstName());
        self::assertSame('Testusername', $chat->username());

        # Message - From
        $from = $message->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());

        # Message - Document
        $document = $message->document();

        $this->sameValue('AwADBAADbXXXXXXXXXXXGBdhD2l6_XX', $document->fileId()->toString());
        self::assertSame('Testfile.pdf', $document->fileName());
        self::assertSame('application/pdf', $document->mimeType());
        self::assertSame(536392, $document->fileSize());
    }

    function testInlineQuery()
    {
        $update = Update::fromApi(json_decode($this->inlineQuery));

        $this->sameValue(10000, $update->updateId());

        # Update - InlineQuery
        $query = $update->inlineQuery();

        $this->sameValue('134567890097', $query->id()->toString());
        $this->sameValue('inline query', $query->query());
        self::assertSame('', $query->offset());

        # InlineQuery - From
        $from = $query->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testChosenInlineQuery()
    {
        $update = Update::fromApi(json_decode($this->chosenInlineQuery));

        $this->sameValue(10000, $update->updateId());

        # Update - ChosenInlineResult
        $inlineResult = $update->chosenInlineResult();

        $this->sameValue('12', $inlineResult->resultId()->toString());
        self::assertSame('inline query', $inlineResult->query());
        $this->sameValue('1234csdbsk4839', $inlineResult->inlineMessageId()->toString());

        # InlineQuery - From
        $from = $inlineResult->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }

    function testCallbackQuery()
    {
        $update = Update::fromApi(json_decode($this->callbackQuery));

        $this->sameValue(10000, $update->updateId());

        # Update - CallbackQuery
        $callbackQuery = $update->callbackQuery();
        
        $this->sameValue('4382bfdwdsb323b2d9', $callbackQuery->id()->toString());
        self::assertSame('Data from button callback', $callbackQuery->data());
        $this->sameValue('1234csdbsk4839', $callbackQuery->inlineMessageId()->toString());

        # InlineQuery - From
        $from = $callbackQuery->from();

        self::assertSame('Test Lastname', $from->lastName());
        $this->sameValue(1111111, $from->userId());
        self::assertSame('Test Firstname', $from->firstName());
        self::assertSame('Testusername', $from->username());
    }
}