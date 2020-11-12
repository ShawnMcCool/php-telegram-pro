<?php namespace TelegramPro\Bot\Methods\Requests;

use TelegramPro\Api\CurlParameters;

interface Request
{
    public function toCurlParameters(string $botToken): CurlParameters;

    public function toJson(): string;
}