<?php namespace TelegramPro\Types;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 */
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

    /**
     * Construct with data received from the Telegram bot api.
     */
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

    /**
     * Optional. True, if the user is allowed to send text messages, contacts, locations and venues
     */
    public function canSendMessages(): bool
    {
        return $this->canSendMessages;
    }

    /**
     * Optional. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
     */
    public function canSendMediaMessages(): bool
    {
        return $this->canSendMediaMessages;
    }

    /**
     * Optional. True, if the user is allowed to send polls, implies can_send_messages
     */
    public function canSendPolls(): bool
    {
        return $this->canSendPolls;
    }

    /**
     * Optional. True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages
     */
    public function canSendOtherMessages(): bool
    {
        return $this->canSendOtherMessages;
    }

    /**
     * Optional. True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages
     */
    public function canAddWebPagePreviews(): bool
    {
        return $this->canAddWebPagePreviews;
    }

    /**
     * Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
     */
    public function canChangeInfo(): bool
    {
        return $this->canChangeInfo;
    }

    /**
     * Optional. True, if the user is allowed to invite new users to the chat
     */
    public function canInviteUsers(): bool
    {
        return $this->canInviteUsers;
    }

    /**
     * Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
     */
    public function canPinMessages(): bool
    {
        return $this->canPinMessages;
    }
}