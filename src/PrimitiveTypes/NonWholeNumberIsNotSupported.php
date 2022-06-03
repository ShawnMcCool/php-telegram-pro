<?php namespace TelegramPro\PrimitiveTypes;

use TelegramPro\TelegramProException;

final class NonWholeNumberIsNotSupported extends \InvalidArgumentException implements TelegramProException
{
}