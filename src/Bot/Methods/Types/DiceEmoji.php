<?php namespace TelegramPro\Bot\Methods\Types;

final class DiceEmoji implements ApiWriteType
{

    public function __construct(
        private string $emoji
    ) {
    }

    public static function dice()
    {
        return new static('🎲');
    }

    public static function darts()
    {
        return new static('🎯');
    }

    public static function basketball()
    {
        return new static('🏀');
    }

    function toApi()
    {
        return $this->emoji;
    }
}