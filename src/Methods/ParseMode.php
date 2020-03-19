<?php namespace TelegramPro\Methods;

final class ParseMode
{
    private string $parseMode;

    private function __construct(string $parseMode)
    {
        $this->parseMode = $parseMode;
    }

    public function toParameter(): string
    {
        return $this->parseMode;
    }

    public static function markdown(): ParseMode
    {
        return new static('MarkdownV2');
    }

    public static function html(): ParseMode
    {
        return new static('HTML');
    }

    public static function none()
    {
        return null;
    }
}