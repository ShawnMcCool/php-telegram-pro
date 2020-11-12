<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Types\ChatPermissions;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\RestrictUntilDate;
use function TelegramPro\optional;

/**
 * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
 */
final class RestrictChatMember implements Method
{
    private ChatId $chatId;
    private UserId $userId;
    private ChatPermissions $permissions;
    private RestrictUntilDate $untilDate;

    private function __construct(
        ChatId $chatId,
        UserId $userId,
        ChatPermissions $permissions,
        RestrictUntilDate $untilDate
    ) {
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->permissions = $permissions;
        $this->untilDate = $untilDate;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'restrictChatMember'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
                'permissions' => $this->permissions->toApi(),
                'until_date' => optional($this->untilDate),
            ]
        );
    }

    public function send(Telegram $telegramApi): RestrictChatMemberResponse
    {
        return RestrictChatMemberResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId,
        ChatPermissions $permissions,
        ?RestrictUntilDate $untilDate = null
    ): RestrictChatMember {
        return new static(
            $chatId,
            $userId,
            $permissions,
            $untilDate
        );
    }
}