<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 */
final class ParseMode implements ApiWriteType
{
    private ?string $parseMode;

    private function __construct(?string $parseMode)
    {
        $this->parseMode = $parseMode;
    }

    public static function markdown(): ParseMode
    {
        return new static('MarkdownV2');
    }

    public static function html(): ParseMode
    {
        return new static('HTML');
    }

    public static function legacyMarkdown(): ParseMode
    {
        return new static('markdown');
    }

    public static function none(): ParseMode
    {
        return new static(null);
    }

    function toApi()
    {
        return $this->parseMode ?? '';
    }
}