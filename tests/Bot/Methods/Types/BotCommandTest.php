<?php namespace Tests\Bot\Methods\Types;

use PHPUnit\Framework\TestCase;
use TelegramPro\Bot\Methods\Types\BotCommand;
use TelegramPro\Bot\Methods\Types\BotCommandIsInvalid;

class BotCommandTest extends TestCase
{
    function testCommandMustBeLongerThan0Characters()
    {
        self::assertSame('c', BotCommand::fromString('c', 'description')->toApi()['command']);

        $this->expectException(BotCommandIsInvalid::class);
        BotCommand::fromString('', 'description');
    }

    function testCommandMustBeShorterThan33Characters()
    {
        BotCommand::fromString(str_repeat('c', 32), 'description');

        $this->expectException(BotCommandIsInvalid::class);
        BotCommand::fromString(str_repeat('c', 33), 'description');
    }

    function testCommandCanOnlyContainLowercaseEnglishLettersDigitsAndUnderscores()
    {
        BotCommand::fromString('abc123___', 'description');

        $this->expectException(BotCommandIsInvalid::class);
        BotCommand::fromString('-', 'description');
    }

    function testDescriptionMustBeLongerThan2Characters()
    {
        self::assertSame('my description', BotCommand::fromString('my_command', 'my description')->toApi()['description']);

        $this->expectException(BotCommandIsInvalid::class);
        BotCommand::fromString('my_command', 'de');
    }
}
