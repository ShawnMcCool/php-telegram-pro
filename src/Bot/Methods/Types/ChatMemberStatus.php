<?php namespace TelegramPro\Bot\Methods\Types;

/**
 * The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked”
 */
final class ChatMemberStatus
{
    private function __construct(
        private string $type
    ) {
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->type;
    }
}