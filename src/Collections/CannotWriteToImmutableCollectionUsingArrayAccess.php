<?php namespace TelegramPro\Collections;

use TelegramPro\TelegramProException;

final class CannotWriteToImmutableCollectionUsingArrayAccess extends \InvalidArgumentException implements TelegramProException
{
}