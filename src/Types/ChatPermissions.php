<?php namespace TelegramPro\Types;

final class ChatPermissions
{
    private bool $canSendMessages;
    private bool $canSendMediaMessages;
    private bool $canSendPolls;
    private bool $canSendOtherMessages;
    private bool $canAddWebPagePreviews;
    private bool $canChangeInfo;
    private bool $canInviteUsers;
    private bool $canPinMessages;

    public function __construct(
        bool $canSendMessages,
        bool $canSendMediaMessages,
        bool $canSendPolls,
        bool $canSendOtherMessages,
        bool $canAddWebPagePreviews,
        bool $canChangeInfo,
        bool $canInviteUsers,
        bool $canPinMessages
    ) {
        $this->canSendMessages = $canSendMessages;
        $this->canSendMediaMessages = $canSendMediaMessages;
        $this->canSendPolls = $canSendPolls;
        $this->canSendOtherMessages = $canSendOtherMessages;
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
        $this->canChangeInfo = $canChangeInfo;
        $this->canInviteUsers = $canInviteUsers;
        $this->canPinMessages = $canPinMessages;
    }

    public static function fromApi($permissions): ?ChatPermissions
    {
        if ( ! $permissions) return null;
        
        return new static(
            $permissions->can_send_messages,
            $permissions->can_send_media_messages,
            $permissions->can_send_polls,
            $permissions->can_send_other_messages,
            $permissions->can_add_web_page_previews,
            $permissions->can_change_info,
            $permissions->can_invite_users,
            $permissions->can_pin_messages
        );
    }
}