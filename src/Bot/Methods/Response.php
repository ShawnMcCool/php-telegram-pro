<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Methods\Types\MethodError;

interface Response
{
    public function ok(): bool;
    public function botInformation();
    public function error(): ?MethodError;
    static function fromApi(string $jsonResponse);
}