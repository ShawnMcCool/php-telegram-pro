<?php namespace TelegramPro\Api;

use TelegramPro\Bot\Methods\Requests\Request;

interface Telegram
{
    public function send(Request $request);
    public function bulkToUsers(Request ...$requests);
}