<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\GetMe;
use TelegramPro\Bot\Types\UserProfilePhotos;
use TelegramPro\Bot\Methods\Types\MethodError;
use TelegramPro\Bot\Methods\GetUserProfilePhotos;

class GetUserProfilePhotosTest extends TelegramTestCase
{
    /**
     * @todo need to update this when more methods are complete
     * so that we can test offsets and limits
     */
    function testGetBotsProfilePhotos()
    {
        $getMeResponse = GetMe::parameters()->send($this->telegram);

        $response = GetUserProfilePhotos::parameters(
            $getMeResponse->botInformation()->userId()
        )->send($this->telegram);

        $this->isOk($response);
        self::assertInstanceOf(UserProfilePhotos::class, $response->userProfilePhotos());
    }

    function testCanParseError()
    {
        $response = GetUserProfilePhotos::parameters(
            UserId::fromInt(1234)
        )->send($this->telegram);

        self::assertFalse($response->ok());
        self::assertInstanceOf(MethodError::class, $response->error());
        self::assertSame('400', $response->error()->code());
        self::assertNotEmpty($response->error()->description());
    }
}
