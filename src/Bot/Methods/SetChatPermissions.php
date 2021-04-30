<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\ChatPermissions;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members admin rights. Returns True on success.
 */
final class SetChatPermissions implements Method
{
    private function __construct(
        private ChatId $chatId,
        private ChatPermissions $permissions
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'setChatPermissions'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'permissions' => $this->permissions->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): SetChatPermissionsResponse
    {
        return SetChatPermissionsResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        ChatPermissions $permissions
    ): SetChatPermissions {
        return new static(
            $chatId,
            $permissions
        );
    }
}