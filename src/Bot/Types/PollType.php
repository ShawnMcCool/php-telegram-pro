<?php namespace TelegramPro\Bot\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class PollType extends StringObject
{
    public function isRegular(): bool
    {
        return $this->string == 'regular';
    }

    public function isQuiz(): bool
    {
        return $this->string == 'quiz';
    }
}