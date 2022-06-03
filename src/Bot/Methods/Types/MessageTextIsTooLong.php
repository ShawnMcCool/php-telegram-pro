<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\TelegramProException;

final class MessageTextIsTooLong extends \InvalidArgumentException implements TelegramProException
{
}