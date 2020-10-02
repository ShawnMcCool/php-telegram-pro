<?php namespace TelegramPro\Bot\Types;


interface ApiReadType
{
    /**
     * @internal Construct with data received from the Telegram bot api.
     * @param $data
     * @return static
     */
    public static function fromApi($data): ?self;
}