<?php namespace TelegramPro\Bot\Methods\Types;

use TelegramPro\Bot\Types\ChatMemberStatus;

/**
 * This object contains information about one member of a chat.
 */
final class ChatMember implements ApiReadType
{
    private function __construct(
        private User $user,
        private ChatMemberStatus $status,
        private ?ChatAdministratorCustomTitle $customTitle,
        private ?RestrictUntilDate $untilDate,
        private ?bool $canBeEdited,
        private ?bool $canPostMessages,
        private ?bool $canEditMessages,
        private ?bool $canDeleteMessages,
        private ?bool $canRestrictMessages,
        private ?bool $canPromoteMembers,
        private ?bool $canChangeInfo,
        private ?bool $canInviteUsers,
        private ?bool $canPinMessages,
        private ?bool $isMember,
        private ?bool $canSendMessages,
        private ?bool $canSendMediaMessages,
        private ?bool $canSendPolls,
        private ?bool $canSendOtherMessages,
        private ?bool $canAddWebPagePreviews
    ) {
    }

    /**
     * Information about the user
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”
     */
    public function status(): ChatMemberStatus
    {
        return $this->status;
    }

    /**
     * Optional. Owner and administrators only. Custom title for this user
     */
    public function customTitle(): ?ChatAdministratorCustomTitle
    {
        return $this->customTitle;
    }

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user; unix time
     */
    public function untilDate(): ?RestrictUntilDate
    {
        return $this->untilDate;
    }

    /**
     * Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user
     */
    public function canBeEdited(): ?bool
    {
        return $this->canBeEdited;
    }

    /**
     * Optional. Administrators only. True, if the administrator can post in the channel; channels only
     */
    public function canPostMessages(): ?bool
    {
        return $this->canPostMessages;
    }

    /**
     * Optional. Administrators only. True, if the administrator can edit messages of other users and can pin messages; channels only
     */
    public function canEditMessages(): ?bool
    {
        return $this->canEditMessages;
    }

    /**
     * Optional. Administrators only. True, if the administrator can delete messages of other users
     */
    public function canDeleteMessages(): ?bool
    {
        return $this->canDeleteMessages;
    }

    /**
     * Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members
     */
    public function canRestrictMessages(): ?bool
    {
        return $this->canRestrictMessages;
    }

    /**
     * Optional. Administrators only. True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     */
    public function canPromoteMembers(): ?bool
    {
        return $this->canPromoteMembers;
    }

    /**
     * Optional. Administrators and restricted only. True, if the user is allowed to change the chat title, photo and other settings
     */
    public function canChangeInfo(): ?bool
    {
        return $this->canChangeInfo;
    }

    /**
     * Optional. Administrators and restricted only. True, if the user is allowed to invite new users to the chat
     */
    public function canInviteUsers(): ?bool
    {
        return $this->canInviteUsers;
    }

    /**
     * Optional. Administrators and restricted only. True, if the user is allowed to pin messages; groups and supergroups only
     */
    public function canPinMessages(): ?bool
    {
        return $this->canPinMessages;
    }

    /**
     * Optional. Restricted only. True, if the user is a member of the chat at the moment of the request
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Optional. Restricted only. True, if the user is allowed to send text messages, contacts, locations and venues
     */
    public function canSendMessages(): ?bool
    {
        return $this->canSendMessages;
    }

    /**
     * Optional. Restricted only. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes
     */
    public function canSendMediaMessages(): ?bool
    {
        return $this->canSendMediaMessages;
    }

    /**
     * Optional. Restricted only. True, if the user is allowed to send polls
     */
    public function canSendPolls(): ?bool
    {
        return $this->canSendPolls;
    }

    /**
     * Optional. Restricted only. True, if the user is allowed to send animations, games, stickers and use inline bots
     */
    public function canSendOtherMessages(): ?bool
    {
        return $this->canSendOtherMessages;
    }

    /**
     * Optional. Restricted only. True, if the user is allowed to add web page previews to their messages
     */
    public function canAddWebPagePreviews(): ?bool
    {
        return $this->canAddWebPagePreviews;
    }

    /**
     * @inheritDoc
     */
    public static function fromApi($data): ?static
    {
        if (is_null($data)) {
            return null;
        }

        return new static(
            User::fromApi($data->user),
            ChatMemberStatus::fromApi($data->status),
            ChatAdministratorCustomTitle::fromApi($data->custom_title ?? null),
            RestrictUntilDate::fromApi($data->until_date ?? null),
            $data->can_be_edited ?? null,
            $data->can_post_messages ?? null,
            $data->can_edit_messages ?? null,
            $data->can_delete_messages ?? null,
            $data->can_restrict_members ?? null,
            $data->can_promote_members ?? null,
            $data->can_change_info ?? null,
            $data->can_invite_users ?? null,
            $data->can_pin_messages ?? null,
            $data->is_member ?? null,
            $data->can_send_messages ?? null,
            $data->can_send_media_messages ?? null,
            $data->can_send_polls ?? null,
            $data->can_send_other_messages ?? null,
            $data->can_add_web_page_previews ?? null,
        );
    }
}