<?php namespace TelegramPro\Bot\Types;

final class PollReadType extends \TelegramPro\PrimitiveTypes\StringObject
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