<?php namespace TelegramPro\Types;

use TelegramPro\Methods\CanNotValidateUrl;

final class Url implements ApiReadType
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

    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?self
    {
        return static::fromString($data);
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