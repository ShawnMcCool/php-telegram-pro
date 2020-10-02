<?php namespace TelegramPro\Api;

use TelegramPro\Bot\Methods\Request;

interface Telegram
{
    public function send(Request $request);
}