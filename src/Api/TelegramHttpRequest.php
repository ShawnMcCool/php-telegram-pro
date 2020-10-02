<?php namespace TelegramPro\Api;

use TelegramPro\Bot\Methods\Request;

/**
 * This object sends requests to the Telegram API using HTTP with Curl.
 * It then returns the response so that the Method object can construct a response object.
 */
final class TelegramHttpRequest implements Telegram
{
    private string $botToken;

    private function __construct(string $botToken)
    {
        $this->botToken = $botToken;
    }

    public function send(Request $request)
    {
        $parameters = $request->toCurlParameters($this->botToken);

        $curl = curl_init($parameters->url());
        curl_setopt_array($curl, $parameters->optionArray());
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public static function botToken(string $botToken): self
    {
        return new static($botToken);
    }
}