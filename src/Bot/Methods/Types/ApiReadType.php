<?php namespace TelegramPro\Bot\Methods\Types;


interface ApiReadType
{
    /**
     * @param $data
     * @return static
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($data): ?static;
}