<?php namespace TelegramPro\Types;

use IteratorAggregate;

interface ReplyMarkup
{
    function toParameter(): ?IteratorAggregate;
}