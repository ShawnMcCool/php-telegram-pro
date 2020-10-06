<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object represent a user's profile pictures.
 */
final class UserProfilePhotos implements ApiReadType
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
    
    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($userProfilePhotos): ?self
    {
        return new static(
            $userProfilePhotos->total_count,
            ArrayOfArrayOfPhotoSizes::fromApi($userProfilePhotos->photos)
        );
    }

    /**
     * Total number of profile pictures the target user has
     */
    public function totalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * Requested profile pictures (in up to 4 sizes each)
     */
    public function photos(): ArrayOfArrayOfPhotoSizes
    {
        return $this->photos;
    }
}