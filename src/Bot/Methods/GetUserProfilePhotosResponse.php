<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Bot\Types\UserProfilePhotos;
use TelegramPro\Bot\Methods\Types\MethodError;

/**
 * Returns a UserProfilePhotos object.
 */
final class GetUserProfilePhotosResponse implements Response
{
    private bool $ok;
    private ?UserProfilePhotos $userProfilePhotos;
    private ?MethodError $error;

    public function __construct(
        bool $ok,
        ?UserProfilePhotos $userProfilePhotos,
        ?MethodError $error
    ) {
        $this->ok = $ok;
        $this->userProfilePhotos = $userProfilePhotos;
        $this->error = $error;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function userProfilePhotos(): ?UserProfilePhotos
    {
        return $this->userProfilePhotos;
    }

    public function error(): ?MethodError
    {
        return $this->error;
    }

    public static function fromApi(string $jsonResponse): static
    {
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            UserProfilePhotos::fromApi($response->result ?? null),
            MethodError::fromApi($response)
        );
    }
}