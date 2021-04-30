<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\QueryStringRequest;

final class GetWebhookInfo implements Method
{
    function send(Telegram $telegramApi): GetWebhookInfoResponse
    {
        return GetWebhookInfoResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    /**
     * Generates a Request object which has all of the information necessary to send a message to the Telegram API.
     * @return Request
     */
    private function request(): Request
    {
        return QueryStringRequest::forMethod('getWebhookInfo');
    }

    public static function parameters(): static
    {
        return new static;
    }
}