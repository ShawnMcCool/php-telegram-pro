<?php namespace TelegramPro\Types;

use Exception;

/**
 * This object contains information about one member of a chat.
 */
final class ChatMember implements ApiReadType
{
    private User $user;
    private ChatMemberStatus $status;
    private ?string $customTitle;
    private ?Date $untilDate;
    private ?bool $canBeEdited;
    private ?bool $canPostMessages;
    private ?bool $canEditMessages;
    private ?bool $canDeleteMessages;
    private ?bool $canRestrictMessages;
    private ?bool $canPromoteMembers;
    private ?bool $canChangeInfo;
    private ?bool $canInviteUsers;
    private ?bool $canPinMessages;
    private ?bool $isMember;
    private ?bool $canSendMessages;
    private ?bool $canSendMediaMessages;
    private ?bool $canSendPolls;
    private ?bool $canSendOtherMessages;
    private ?bool $canAddWebPagePreviews;

    private function __construct(
        User $user,
        ChatMemberStatus $status,
        ?string $customTitle,
        ?Date $untilDate,
        ?bool $canBeEdited,
        ?bool $canPostMessages,
        ?bool $canEditMessages,
        ?bool $canDeleteMessages,
        ?bool $canRestrictMessages,
        ?bool $canPromoteMembers,
        ?bool $canChangeInfo,
        ?bool $canInviteUsers,
        ?bool $canPinMessages,
        ?bool $isMember,
        ?bool $canSendMessages,
        ?bool $canSendMediaMessages,
        ?bool $canSendPolls,
        ?bool $canSendOtherMessages,
        ?bool $canAddWebPagePreviews
    ) {
        $this->user = $user;
        $this->status = $status;
        $this->customTitle = $customTitle;
        $this->untilDate = $untilDate;
        $this->canBeEdited = $canBeEdited;
        $this->canPostMessages = $canPostMessages;
        $this->canEditMessages = $canEditMessages;
        $this->canDeleteMessages = $canDeleteMessages;
        $this->canRestrictMessages = $canRestrictMessages;
        $this->canPromoteMembers = $canPromoteMembers;
        $this->canChangeInfo = $canChangeInfo;
        $this->canInviteUsers = $canInviteUsers;
        $this->canPinMessages = $canPinMessages;
        $this->isMember = $isMember;
        $this->canSendMessages = $canSendMessages;
        $this->canSendMediaMessages = $canSendMediaMessages;
        $this->canSendPolls = $canSendPolls;
        $this->canSendOtherMessages = $canSendOtherMessages;
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
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
    public function customTitle(): ?string
    {
        return $this->customTitle;
    }

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user; unix time
     */
    public function untilDate(): ?Date
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
    public static function fromApi($data): ?self
    {
        throw new Exception('not implemented');
    }
}