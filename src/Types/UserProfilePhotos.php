<?php namespace TelegramPro\Types;

/**
 * This object represent a user's profile pictures.
 */
final class UserProfilePhotos
{
    private int $totalCount;
    private ArrayOfArrayOfPhotoSizes $photos;

    private function __construct(
        int $totalCount,
        ArrayOfArrayOfPhotoSizes $photos
    ) {
        $this->totalCount = $totalCount;
        $this->photos = $photos;
    }

    public static function fromApi($userProfilePhotos): ?self
    {
        return new static(
            $userProfilePhotos->total_count,
            ArrayOfArrayOfPhotoSizes::fromApi($userProfilePhotos->photos)
        );
    }

    public function totalCount(): int
    {
        return $this->totalCount;
    }

    public function photos(): ArrayOfArrayOfPhotoSizes
    {
        return $this->photos;
    }
}