<?php namespace TelegramPro\Bot\Methods;

use TelegramPro\Api\Telegram;
use TelegramPro\Bot\Types\UserId;
use TelegramPro\Bot\Methods\Types\ChatId;
use TelegramPro\Bot\Methods\Requests\Request;
use TelegramPro\Bot\Methods\Requests\JsonRequest;
use TelegramPro\Bot\Methods\Types\PromotionCapabilities;

/**
 * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
 */
final class PromoteChatMember implements Method
{
    private function __construct(
        private ChatId $chatId,
        private UserId $userId,
        private ?bool $canChangeInfo,
        private ?bool $canPostMessages,
        private ?bool $canEditMessages,
        private ?bool $canDeleteMessages,
        private ?bool $canInviteUsers,
        private ?bool $canRestrictMembers,
        private ?bool $canPinMessages,
        private ?bool $canPromoteMembers
    ) {
    }

    function request(): Request
    {
        return JsonRequest::forMethod(
            'promoteChatMember'
        )->withParameters(
            [
                'chat_id' => $this->chatId->toApi(),
                'user_id' => $this->userId->toApi(),
                'can_change_info' => $this->canChangeInfo,
                'can_post_messages' => $this->canPostMessages,
                'can_edit_messages' => $this->canEditMessages,
                'can_delete_messages' => $this->canDeleteMessages,
                'can_invite_users' => $this->canInviteUsers,
                'can_restrict_members' => $this->canRestrictMembers,
                'can_pin_messages' => $this->canPinMessages,
                'can_promote_members' => $this->canPromoteMembers,
            ]
        );
    }

    public function send(Telegram $telegramApi): PromoteChatMemberResponse
    {
        return PromoteChatMemberResponse::fromApi(
            $telegramApi->send($this->request())
        );
    }

    public static function parameters(
        ChatId $chatId,
        UserId $userId,
        PromotionCapabilities $capabilities
    ): PromoteChatMember {
        return new static(
            $chatId,
            $userId,
            ... $capabilities->allCapabilities()
        );
    }
}