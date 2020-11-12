<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Types\BanUntilDate;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use function TelegramPro\optional;

/**
 * Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 */
final class KickChatMember implements Method
{
    private ChatId $chatId;
    private UserId $userId;
    private ?BanUntilDate $untilDate;

    private function __construct(
        ChatId $chatId,
        UserId $userId,
        ?BanUntilDate $untilDate
    ) {
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->untilDate = $untilDate;
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'kickChatMember'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
                'until_date' => optional($this->untilDate),
            ]
        );
    }

    public function send(Telegram $telegramApi): KickChatMemberResponse
    {
        return KickChatMemberResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId,
        ?BanUntilDate $untilDate = null
    ): KickChatMember {
        return new static(
            $chatId,
            $userId,
            $untilDate
        );
    }
}