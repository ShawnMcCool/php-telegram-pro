<?php namespace TelegramPro\Bot\Methods\Types;

final class Url implements ApiReadType, ApiWriteType
{
    private function __construct(
        private string $url
    ) {
    }

    public function toString(): string
    {
        return $this->url;
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

    public static function fromApi($url): ?static
    {
        return new static($url);
    }

    function toApi()
    {
        return $this->url;
    }
}