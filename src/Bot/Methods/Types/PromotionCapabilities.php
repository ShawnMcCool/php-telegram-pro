<?php namespace TelegramPro\Bot\Methods\Types;

final class PromotionCapabilities
{
    private array $capabilities = [];

    public function allCapabilities(): array
    {
        return $this->capabilities;
    }

    public function canChangeInfo(): self
    {
        $this->capabilities['can_change_info'] = true;
        return $this;
    }

    public function canPostMessages(): self
    {
        $this->capabilities['can_post_messages'] = true;
        return $this;
    }

    public function canEditMessages(): self
    {
        $this->capabilities['can_edit_messages'] = true;
        return $this;
    }

    public function canDeleteMessages(): self
    {
        $this->capabilities['can_delete_messages'] = true;
        return $this;
    }

    public function canInviteUsers(): self
    {
        $this->capabilities['can_invite_users'] = true;
        return $this;
    }

    public function canRestrictMembers(): self
    {
        $this->capabilities['can_restrict_members'] = true;
        return $this;
    }

    public function canPinMessages(): self
    {
        $this->capabilities['can_pin_messages'] = true;
        return $this;
    }

    public function canPromoteMembers(): self
    {
        $this->capabilities['can_promote_members'] = true;
        return $this;
    }

    public static function define(): self
    {
        return new static;
    }

    public static function demoteMember(): self
    {
        return new static;
    }
}