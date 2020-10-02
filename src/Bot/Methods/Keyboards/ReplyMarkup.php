<?php namespace TelegramPro\Bot\Methods\Keyboards;

use TelegramPro\Bot\Types\ArrayOfInlineKeyboardRows;

interface ReplyMarkup
{
    function toParameter(): ArrayOfInlineKeyboardRows;
}