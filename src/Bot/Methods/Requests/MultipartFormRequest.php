<?php namespace TelegramPro\Bot\Methods\Requests;

use TelegramPro\Api\CurlParameters;
use TelegramPro\Bot\Methods\FileUploads\FileToUpload;
use TelegramPro\Bot\Methods\FileUploads\FilesToUpload;

final class MultipartFormRequest implements Request
{
    private string $method;
    private array $parameters = [];
    private FilesToUpload $filesToUpload;

    private function __construct(string $method)
    {
        $this->method = $method;
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

    public static function forMethod(string $method): static
    {
        return new static($method);
    }
}