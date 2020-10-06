<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

final class PollQuestion extends StringObject
{
    public static function fromApi($question): ?self
    {
        if (is_null($question)) {
            return null;
        }

        if (strlen($question) > 255) {
            throw new PollQuestionTextIsTooLong("Poll Question text '{$question}' can not be longer than 255 characters.");
        }

        return new static($question);
    }
}