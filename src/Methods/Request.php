<?php namespace TelegramPro\Methods;

use TelegramPro\Types\InputFile;
use TelegramPro\Api\CurlParameters;

final class Request
{
    private string $method;
    private string $requestType;

    private array $parameters = [];
    private array $files = [];

    private function __construct(
        string $method,
        string $requestType
    ) {
        $this->method = $method;
        $this->requestType = $requestType;
    }

    public function withParameters(array $parameterArray): self
    {

        $this->parameters = $parameterArray;
        return $this;
    }

    public function withFiles(array $files): self
    {
        $this->files = $files;
        return $this;
    }

    public function toCurlParameters(string $botToken): CurlParameters
    {
        return new CurlParameters(
            "https://api.telegram.org/bot{$botToken}/{$this->method}",
            [
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $this->parameters(),
                CURLOPT_SSL_VERIFYPEER => false,
            ]
        );
    }

    private function parameters(): array
    {
        $fileParameters = [];

        /** @var InputFile $file */
        foreach ($this->files as $fieldName => $file) {
            if ( ! $file) continue;

            if ($file->fileToUpload()) {
                $fileParameters[$file->fileToUpload()->formFieldName()] = $file->fileToUpload()->curlFile();
            }

            $fileParameters[$fieldName] = $file->inputFileString();
        }

        return array_filter(
            array_merge(
                $this->parameters,
                $fileParameters
            )
        );
    }

    public static function queryString(string $method): self
    {
        return new static($method, 'query-string');
    }

    public static function xWwwFormUrlencoded(string $method): self
    {
        return new static($method, 'application/x-www-form-urlencoded');
    }

    public static function multipartFormData(string $method): self
    {
        return new static($method, 'multipart/form-data');
    }

    public static function json(string $method): self
    {
        return new static($method, 'application/json');
    }
}