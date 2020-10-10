<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;

/**
 * Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
 */
final class UnbanChatMember implements Method
{
    private ChatId $chatId;
    private UserId $userId;

    private function __construct(
        ChatId $chatId,
        UserId $userId
    ) {
        $this->chatId = $chatId;
        $this->userId = $userId;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'unbanChatMember'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
            ]
        );
    }

    public function send(Telegram $telegramApi): UnbanChatMemberResponse
    {
        return UnbanChatMemberResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId
    ): UnbanChatMember {
        return new static(
            $chatId,
            $userId
        );
    }
}