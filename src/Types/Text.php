<?php namespace TelegramPro\Types;

final class Text
{
    private string $text;
    private ParseMode $parseMode;

    public function __construct(
        ?string $text,
        ParseMode $parseMode
    ) {
        $this->text = $text;
        $this->parseMode = $parseMode;
    }

    public function text(): ?string
    {
        return $this->text;
    }

    public function parseMode(): ParseMode
    {
        return $this->parseMode;
    }

    public static function plain(string $text): Text
    {
        return new static($text, ParseMode::none());
    }

    public static function markdown(string $markdown): Text
    {
        return new static($markdown, ParseMode::markdown());
    }

    public static function html(string $html): Text
    {
        return new static($html, ParseMode::html());
    }

    public static function legacyMarkdown(string $legacyMarkdown): Text
    {
        return new static($legacyMarkdown, ParseMode::legacyMarkdown());
    }

    public static function none(): Text
    {
        return new static(null, ParseMode::none());
    }
}