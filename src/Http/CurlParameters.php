<?php namespace TelegramPro\Http;

final class CurlParameters
***REMOVED***
    private string $url;
    private array $optionArray;

    public function __construct(string $url, array $optionArray = [])
    ***REMOVED***
        $this->url = $url;
        $this->optionArray = $optionArray;
    ***REMOVED***

    public function url(): string
    ***REMOVED***
        return $this->url;
    ***REMOVED***

    public function optionArray(): array
    ***REMOVED***
        return $this->optionArray;
    ***REMOVED***
***REMOVED***