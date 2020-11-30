<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\PrimitiveTypes\StringObject;

/**
 * Poll option text, 1-100 characters
 */
final class PollOptionText extends StringObject
{
    public static function fromString($pollOptionText): ?static
    {
        if (is_null($pollOptionText)) {
            return null;
        }

        if (empty($pollOptionText)) {
            throw new PollTextCanNotBeEmpty;
        }

        if (strlen($pollOptionText) > 100) {
            throw new PollOptionTextIsTooLong("Poll Option text '{$pollOptionText}' can not be longer than 100 characters.");
        }

        return new static($pollOptionText);
    }
}