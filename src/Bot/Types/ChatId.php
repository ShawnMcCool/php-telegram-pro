<?php namespace TelegramPro\Bot\Types;

use TelegramPro\PrimitiveTypes\IntegerObject;

/**
 *  Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 */
final class ChatId extends IntegerObject
{
}