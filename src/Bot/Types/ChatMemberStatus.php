<?php namespace TelegramPro\Bot\Types;

/**
 * The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”
 */
final class ChatMemberStatus extends \TelegramPro\PrimitiveTypes\StringObject
{
    public function isCreator(): bool
    {
        return $this->string == 'creator';
    }

    public function isAdministrator(): bool
    {
        return $this->string == 'administrator';
    }

    public function isMember(): bool
    {
        return $this->string == 'member';
    }

    public function isRestricted(): bool
    {
        return $this->string == 'restricted';
    }

    public function isLeft(): bool
    {
        return $this->string == 'left';
    }

    public function isKicked(): bool
    {
        return $this->string == 'kicked';
    }
}