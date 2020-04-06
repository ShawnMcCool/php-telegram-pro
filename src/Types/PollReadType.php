<?php namespace TelegramPro\Types;

final class PollReadType extends ApiReadString
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