<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;
use TelegramPro\Bot\Methods\Types\ApiWriteType;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 */
final class ChatPermissions implements ApiReadType, ApiWriteType
{
    const CAN_SEND_MESSAGES = 'can_send_messages';
    const CAN_SEND_MEDIA_MESSAGES = 'can_send_media_messages';
    const CAN_SEND_POLLS = 'can_send_polls';
    const CAN_SEND_OTHER_MESSAGES = 'can_send_other_messages';
    const CAN_ADD_WEB_PAGE_PREVIEWS = 'can_add_web_page_previews';
    const CAN_CHANGE_INFO = 'can_change_info';
    const CAN_INVITE_USERS = 'can_invite_users';
    const CAN_PIN_MESSAGES = 'can_pin_messages';

    private bool $canSendMessages;
    private bool $canSendMediaMessages;
    private bool $canSendPolls;
    private bool $canSendOtherMessages;
    private bool $canAddWebPagePreviews;
    private bool $canChangeInfo;
    private bool $canInviteUsers;
    private bool $canPinMessages;

    private function __construct(
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

    function toApi()
    {
        return json_encode(
            [
                'can_send_messages' => $this->canSendMessages,
                'can_send_media_messages' => $this->canSendMediaMessages,
                'can_send_polls' => $this->canSendPolls,
                'can_send_other_messages' => $this->canSendOtherMessages,
                'can_add_web_page_previews' => $this->canAddWebPagePreviews,
                'can_change_info' => $this->canChangeInfo,
                'can_invite_users' => $this->canInviteUsers,
                'can_pin_messages' => $this->canPinMessages,
            ]
        );
    }

    /**
     * @internal Construct with data received from the Telegram bot api.
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

    public static function fromList(...$permissions): self
    {
        $allPossiblePermissions = [
            'can_send_messages',
            'can_send_media_messages',
            'can_send_polls',
            'can_send_other_messages',
            'can_add_web_page_previews',
            'can_change_info',
            'can_invite_users',
            'can_pin_messages',
        ];
        
        $invalidPermissions = [];
        
        foreach ($permissions as $permission) {
            if ( ! in_array($permission, $allPossiblePermissions)) {
                $invalidPermissions[] = $permission;
            }
        }
        
        if ($invalidPermissions) {
            throw new InvalidChatPermissionsSpecified(implode(', ', $invalidPermissions));
        }
        
        return new static(
            in_array(ChatPermissions::CAN_SEND_MESSAGES, $permissions),
            in_array(ChatPermissions::CAN_SEND_MEDIA_MESSAGES, $permissions),
            in_array(ChatPermissions::CAN_SEND_POLLS, $permissions),
            in_array(ChatPermissions::CAN_SEND_OTHER_MESSAGES, $permissions),
            in_array(ChatPermissions::CAN_ADD_WEB_PAGE_PREVIEWS, $permissions),
            in_array(ChatPermissions::CAN_CHANGE_INFO, $permissions),
            in_array(ChatPermissions::CAN_INVITE_USERS, $permissions),
            in_array(ChatPermissions::CAN_PIN_MESSAGES, $permissions),
        );
    }
}