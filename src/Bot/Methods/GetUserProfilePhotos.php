<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\UserProfilePhotoLimit;
use function TelegramPro\optional;

/**
 * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 */
final class GetUserProfilePhotos implements Method
{
    private UserId $userId;
    private ?int $offset;
    private ?UserProfilePhotoLimit $limit;

    private function __construct(
        UserId $userId,
        ?int $offset,
        ?UserProfilePhotoLimit $limit
    ) {
        $this->userId = $userId;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'getUserProfilePhotos'
        )->withParameters(
            [
                'user_id' => $this->userId->toApi(),
                'offset' => optional($this->offset),
                'limit' => optional($this->limit),
            ]
        );
    }

    public function send(Telegram $telegramApi): GetUserProfilePhotosResponse
    {
        return GetUserProfilePhotosResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        UserId $userId,
        ?int $offset = null,
        ?UserProfilePhotoLimit $limit = null
    ): GetUserProfilePhotos {
        return new static(
            $userId,
            $offset,
            $limit
        );
    }
}