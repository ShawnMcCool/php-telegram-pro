<?php namespace Tests\Bot\Types;

use TelegramPro\Bot\Types\ChatPermissions;
use PHPUnit\Framework\TestCase;
use TelegramPro\Bot\Types\InvalidChatPermissionsSpecified;

class ChatPermissionsTest extends TestCase
{
    public function testCanConstructFromAConstantList()
    {
        $permissions = ChatPermissions::fromList(
            ChatPermissions::CAN_SEND_MEDIA_MESSAGES,
            ChatPermissions::CAN_INVITE_USERS
        );
        
        self::assertTrue($permissions->canSendMediaMessages());
        self::assertTrue($permissions->canInviteUsers());
        self::assertFalse($permissions->canPinMessages());
        self::assertFalse($permissions->canSendPolls());
    }

    public function testThrowsOnInvalidPermissionName()
    {
        $this->expectException(InvalidChatPermissionsSpecified::class);
        
        ChatPermissions::fromList(
            'not a real permission',
            ChatPermissions::CAN_INVITE_USERS
        );        
    }
}
