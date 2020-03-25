<?php namespace Tests\Terminal;

final class Ansi
{
    /** @var string */
    private $text;
    /** @var array */
    private $tags;

    public function __construct(string $text, ...$tags)
    {
        $this->text = $text;
        $this->tags = $tags;
    }

    public function __toString()
    {
        $openTag = array_reduce(
            $this->tags,
            fn($string, $tag) => $string . "\033[{$tag}m",
            ''
        );

        $closeTag = array_reduce(
            $this->tags,
            fn($string, $tag) => $string . $string . "\033[0m",
            ''
        );

        return $openTag . $this->text . $closeTag;
    }

    public static function format(string $text, int ...$ansiCodes)
    {
        return new static($text, $ansiCodes);
    }

    public static function red(string $text): Ansi
    {
        return new static($text, AnsiCodes::$red);
    }

    public static function green(string $text): Ansi
    {
        return new static($text, AnsiCodes::$green);
    }

    public static function yellow(string $text): Ansi
    {
        return new static($text, AnsiCodes::$yellow);
    }

    public static function blue(string $text): Ansi
    {
        return new static($text, AnsiCodes::$blue);
    }

    public static function magenta(string $text): Ansi
    {
        return new static($text, AnsiCodes::$magenta);
    }

    public static function cyan(string $text): Ansi
    {
        return new static($text, AnsiCodes::$cyan);
    }

    public static function white(string $text): Ansi
    {
        return new static($text, AnsiCodes::$white);
    }

    public static function bold(string $text): Ansi
    {
        return new static($text, AnsiCodes::$bold);
    }

    public static function italic(string $text): Ansi
    {
        return new static($text, AnsiCodes::$italic);
    }

    public static function underline(string $text): Ansi
    {
        return new static($text, AnsiCodes::$underline);
    }

    public static function blink(string $text): Ansi
    {
        return new static($text, AnsiCodes::$blink);
    }
}