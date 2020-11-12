<?php namespace TelegramPro\Bot\Methods\Types;

final class DiceEmoji implements ApiWriteType
{
    private string $emoji;

    public function __construct(string $emoji)
    {
        $this->emoji = $emoji;
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