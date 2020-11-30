<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\CurlParameters;
use TelegramPro\Bot\Methods\FileUploads\FileToUpload;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;

final class RequestRepo
{
    private string $method;
    private string $requestType;

    private array $parameters = [];
    private FilesToUpload $filesToUpload;

    private function __construct(
        string $method,
        string $requestType
    ) {
        $this->method = $method;
        $this->requestType = $requestType;
        $this->filesToUpload = FilesToUpload::empty();
    }

    public function withParameters(array $parameterArray): static
    {
        $this->parameters = $parameterArray;
        return $this;
    }

    public function withFiles(?FilesToUpload $files = null): static
    {
        $this->filesToUpload->merge($files);
        return $this;
    }

    public function toCurlParameters(string $botToken): CurlParameters
    {
        return $this->jsonExample($botToken);
        #return $this->queryStringExample($botToken);
        #return $this->xWwwFormUrlencodedExample($botToken);
        #return $this->multipartFormExample($botToken);
    }

    /**
     * Return JSON encoded object for sending to Telegram as a response to an update.
     * https://core.telegram.org/bots/faq#how-can-i-make-requests-in-response-to-updates
     */
    public function toJson(): string
    {
        return json_encode(
            array_merge(
                [
                    'method' => $this->method,
                ],
                $this->parameters()
            )
        );
    }

    private function jsonExample(string $botToken): CurlParameters
    {
        $jsonData = json_encode($this->parameters());
        $dataLength = strlen($jsonData);

        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Content-Length: ' . $dataLength,
                ],
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    private function queryStringExample(string $botToken): CurlParameters
    {
        $parameters = http_build_query($this->parameters());

        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}?{$parameters}",
            [
                CURLOPT_HTTPHEADER => ['Content-Type: multipart/form-data'],
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => 0,
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    private function multipartFormExample(string $botToken): CurlParameters
    {
        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HTTPHEADER => ['Content-Type: multipart/form-data'],
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $this->parameters(),
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    private function xWwwFormUrlencodedExample(string $botToken): CurlParameters
    {
        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query($this->parameters()),
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    private function parameters(): array
    {
        $fileParameters = [];

        /** @var FileToUpload $file */
        foreach ($this->filesToUpload as $file) {
            if ( ! $file) continue;
            $fileParameters[$file->formFieldName()] = $file->curlFile();
        }

        return array_filter(
            array_merge(
                $this->parameters,
                $fileParameters
            )
        );
    }

    public static function queryString(string $method): static
    {
        return new static($method, 'query-string');
    }

    public static function xWwwFormUrlencoded(string $method): static
    {
        return new static($method, 'application/x-www-form-urlencoded');
    }

    public static function multipartFormData(string $method): static
    {
        return new static($method, 'multipart/form-data');
    }

    public static function json(string $method): static
    {
        return new static($method, 'application/json');
    }
}