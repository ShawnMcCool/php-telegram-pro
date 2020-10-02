<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;

/**
 * Methods are commands that can be sent to the Telegram API. They represent the "write" side of the API.
 * The read side is represented by "Updates".
 * @package TelegramPro\Methods
 */
interface Method
{
    /**
     * @param Telegram $telegramApi
     * @return Response
     */
    function send(Telegram $telegramApi): Response;
}