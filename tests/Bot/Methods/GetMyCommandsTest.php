<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\GetMe;
use TelegramPro\Bot\Methods\Types\User;
use TelegramPro\Bot\Methods\GetMyCommands;
use TelegramPro\Bot\Methods\SetMyCommands;
use TelegramPro\Bot\Methods\Types\BotCommand;
use TelegramPro\Bot\Methods\Types\ArrayOfBotCommands;

class GetMyCommandsTest extends TelegramTestCase
{
    function testCanGetOwnCommands()
    {
        SetMyCommands::parameters(
            ArrayOfBotCommands::fromList(
                BotCommand::fromString('say_hi', 'say hi description'),
                BotCommand::fromString('run_away', 'run away description'),
            )
        )->send($this->telegram);
        
        $response = GetMyCommands::parameters()
                         ->send($this->telegram);

        $this->isOk($response);
        
        self::assertInstanceOf(ArrayOfBotCommands::class, $response->commands());
        self::assertCount(2, $response->commands());
        
        SetMyCommands::parameters(
            ArrayOfBotCommands::fromList(
                BotCommand::fromString('say_hi', 'say hi description'),
            )
        )->send($this->telegram);
        
        $response = GetMyCommands::parameters()
                         ->send($this->telegram);

        $this->isOk($response);
        self::assertCount(1, $response->commands());
    }
}