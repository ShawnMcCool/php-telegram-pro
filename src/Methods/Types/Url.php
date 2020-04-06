<?php namespace TelegramPro\Methods\Types;

final class Url
{
    private string $url;

    private function __construct(string $url)
    {
        $this->url = $url;
    }

    public function toString(): string
    {
        return $this->url;
    }

    public function __toString()
    {
        return $this->toString();
    }
    
    public static function fromString(?string $url): ?Url
    {
        if (is_null($url)) {
            return null;
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            throw new CanNotValidateUrl($url);
        }

        return new static($url);
    }
}