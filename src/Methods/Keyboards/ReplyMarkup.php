<?php namespace TelegramPro\Methods\Keyboards;

use TelegramPro\Types\ArrayOfInlineKeyboardRows;

interface ReplyMarkup
{
    function toParameter(): ArrayOfInlineKeyboardRows;
}