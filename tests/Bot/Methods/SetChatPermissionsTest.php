<?php namespace Tests\Bot\Methods;

use Tests\TelegramTestCase;

class SetChatPermissionsTest extends TelegramTestCase
{
    /**
     * @doesNotPerformAssertions
     * @todo not enough rights to change chat permissions
     */
    function testCanSetPermissions()
    {
//        $response = SetChatPermissions::parameters(
//            $this->config->chatId(),
//            ChatPermissions::fromList(
//                ChatPermissions::CAN_INVITE_USERS
//            )
//        )->send($this->telegram);
//        
//        $this->isOk($response);
//        self::assertInstanceOf(Message::class, $response->permissionsWereSet());
    }
}
