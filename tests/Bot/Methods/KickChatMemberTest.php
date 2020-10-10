<?php namespace Tests\Bot\Methods;

use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\KickChatMember;
use PHPUnit\Framework\TestCase;
use TelegramPro\Bot\Methods\Types\BanUntilDate;

class KickChatMemberTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     * @todo find a way so that it will
     */
    function testShouldFindAWayToTestThis() {

        KickChatMember::parameters(
            ChatId::fromInt(123),
            UserId::fromInt(321)
        );
                
        KickChatMember::parameters(
            ChatId::fromInt(123),
            UserId::fromInt(321),
            BanUntilDate::forever()
        );

        KickChatMember::parameters(
            ChatId::fromInt(123),
            UserId::fromInt(321),
            BanUntilDate::fromString('next thursday')
        );
        
        KickChatMember::parameters(
            ChatId::fromInt(123),
            UserId::fromInt(321),
            BanUntilDate::fromString('+1 week')
        );
        
    }
}
