<?php namespace TelegramPro\Methods;

final class ParseMode
***REMOVED***
    private string $parseMode;

    private function __construct(string $parseMode)
    ***REMOVED***
        $this->parseMode = $parseMode;
    ***REMOVED***

    public static function markdown(): ParseMode
    ***REMOVED***
        return new static('MarkdownV2');
    ***REMOVED***

    public static function html(): ParseMode
    ***REMOVED***
        return new static('HTML');
    ***REMOVED***

    public function toParameter(): string
    ***REMOVED***
        return $this->parseMode;
    ***REMOVED***
***REMOVED***