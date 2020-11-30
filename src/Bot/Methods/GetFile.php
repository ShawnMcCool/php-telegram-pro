<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\FileId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
 * Note: This function may not preserve the original file name and MIME type. You should save the file's MIME type and name (if available) when the File object is received.
 */
final class GetFile implements Method
{
    private FileId $fileId;

    private function __construct(
        FileId $fileId
    ) {
        $this->fileId = $fileId;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'getFile'
        )->withParameters(
            [
                'file_id' => $this->fileId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): GetFileResponse
    {
        return GetFileResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        FileId $fileId
    ): static {
        return new static(
            $fileId
        );
    }
}