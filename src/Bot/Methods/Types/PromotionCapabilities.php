<?php namespace TelegramPro\Bot\Methods\Types;

final class PromotionCapabilities
{
    private array $capabilities = [];

    public function allCapabilities(): array
    {
        return $this->capabilities;
    }

    public function canChangeInfo(): static
    {
        $this->capabilities['can_change_info'] = true;
        return $this;
    }

    public function canPostMessages(): static
    {
        $this->capabilities['can_post_messages'] = true;
        return $this;
    }

    public function canEditMessages(): static
    {
        $this->capabilities['can_edit_messages'] = true;
        return $this;
    }

    public function canDeleteMessages(): static
    {
        $this->capabilities['can_delete_messages'] = true;
        return $this;
    }

    public function canInviteUsers(): static
    {
        $this->capabilities['can_invite_users'] = true;
        return $this;
    }

    public function canRestrictMembers(): static
    {
        $this->capabilities['can_restrict_members'] = true;
        return $this;
    }

    public function canPinMessages(): static
    {
        $this->capabilities['can_pin_messages'] = true;
        return $this;
    }

    public function canPromoteMembers(): static
    {
        $this->capabilities['can_promote_members'] = true;
        return $this;
    }

    public static function define(): static
    {
        return new static;
    }

    public static function demoteMember(): static
    {
        return new static;
    }
}