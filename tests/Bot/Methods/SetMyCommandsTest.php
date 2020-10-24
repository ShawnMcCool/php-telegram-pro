<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SetMyCommands;
use TelegramPro\Bot\Methods\Types\BotCommand;
use TelegramPro\Bot\Methods\Types\ArrayOfBotCommands;

class SetMyCommandsTest extends TelegramTestCase
{
    function testSetChatPhotoWithFilePath()
    {
        $response = SetMyCommands::parameters(
            ArrayOfBotCommands::fromList(
                BotCommand::fromString('say_hi', 'say hi description'),
                BotCommand::fromString('run_away', 'run away description'),
            )
        )->send($this->telegram);

        $this->isOk($response);
        self::assertTrue($response->commandsWereSet());
    }

    /**
     * @todo figure out how to make this command fail
     * @doesNotPerformAssertions
     */
    function testCanParseError()
    {
//        $response = SetMyCommands::parameters(
//            ArrayOfBotCommands::fromList(
//                BotCommand::fromString('say_hi', 'say hi description'),
//                BotCommand::fromString('run_away', 'run away description'),
//            )
//        )->send($this->telegram);
//
//        self::assertFalse($response->ok());
//        self::assertInstanceOf(MethodError::class, $response->error());
//        self::assertSame('400', $response->error()->code());
//        self::assertNotEmpty($response->error()->description());
    }
}