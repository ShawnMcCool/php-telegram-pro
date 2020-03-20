<?php
namespace TelegramPro\Api;

use TelegramPro\Methods\Method;

interface Telegram
{
    public function send(Method $method);
}