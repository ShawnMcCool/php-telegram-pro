<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Methods\SendDice;
use TelegramPro\Bot\Methods\Types\Message;
use TelegramPro\Bot\Methods\Types\DiceEmoji;
use TelegramPro\Bot\Methods\Types\MessageText;
use TelegramPro\Bot\Methods\Types\MethodError;

class SendDiceTest extends TelegramTestCase
{
    function testSendDart()
    {
        $response = SendDice::parameters(
            $this->config->supergroupChatId(),
            DiceEmoji::darts()
        )->send($this->telegram);

        $this->isOk($response);

        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendBasketball()
    {
        $response = SendDice::parameters(
            $this->config->supergroupChatId(),
            DiceEmoji::basketball()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }

    function testSendDice()
    {
        $response = SendDice::parameters(
            $this->config->supergroupChatId(),
            DiceEmoji::dice()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertSame(DiceEmoji::dice()->toApi(), $response->sentMessage()->dice()->emoji());
        self::assertInstanceOf(Message::class, $response->sentMessage());
    }
    
    function testCanParseError()
    {
        $response = SendDice::parameters(
            $this->config->wrongGroupId(),
            DiceEmoji::dice()
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
