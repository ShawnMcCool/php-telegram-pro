<?php namespace TelegramPro\Types;

interface ReplyMarkup
{
    function toParameter(): ArrayOfInlineKeyboardRows;
}