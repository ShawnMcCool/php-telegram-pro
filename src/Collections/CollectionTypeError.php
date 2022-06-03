<?php namespace TelegramPro\Collections;

use TelegramPro\TelegramProException;

final class CollectionTypeError extends \InvalidArgumentException implements TelegramProException
{
    public static function cannotMergeDifferentTypes($one, $two)
    {
        $oneType = is_object($one) ? get_class($one) : gettype($one);
        $oneCount = $one->count();
        $twoType = is_object($two) ? get_class($two) : gettype($two);
        $twoCount = $two->count();

        $message = <<<EOF
Can not merge collection objects which have different types.

Attempted to merge a collection of type {$oneType} containing {$oneCount} items with\n
a collection of {$twoType} containing {$twoCount} elements.
EOF;

        return new static($message);
    }
}